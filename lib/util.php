<?php
function getDBEngineType() {
	$db_engine_type = '';
	if (DBINFO::$DBTYPE == 'mysql') {
		$db_engine_type = 'ENGINE=InnoDB DEFAULT CHARSET=latin1';
	}
	return $db_engine_type;
}
function _json_decode($string) {
	if (get_magic_quotes_gpc ()) {
		$string = stripslashes ( $string );
	}	
	return json_decode ( $string );
}
function clearError() {
	$_SESSION ['error'] = '';
}
function getExportFrom() {
	return $_SESSION ['export_from'];
}
function getExportTo() {
	return $_SESSION ['export_to'];
}
function setError($errormsg) {
	if (getTransactionCount () > 1) {
		$_SESSION ['error'] = 'More then one transaction are used , please check the transaction status';
	} else {
		$_SESSION ['error'] = $errormsg;
	}
}
function getError() {
	return $_SESSION ['error'];
}
function getAppId() {
	if(isset($_SESSION ['appid'])){
	return $_SESSION ['appid'];	
	}else{
	return "";
	}	
}
function getProductId() {
	return $_SESSION ['pid'];
}
function getEditionIndex() {
	return $_SESSION ['editionindex'];
}
function setReqObj($obj) {
	$_SESSION ['obj'] = $obj;
}
function setAPIObj($obj) {
	$_SESSION ['apiobj'] = $obj;
}
function getAPIObj() {
	$apiobj = null;
	if (isset ( $_SESSION ['apiobj'] )) {
		$apiobj = $_SESSION ['apiobj'];
	}
	return $apiobj;
}
function getReqObj() {
	if(isset($_SESSION ['obj'])){
	return $_SESSION ['obj'];	
	}else{
	return new stdClass();	
	}	
}
function isAdminProfile($con, $userid) {
	$sql = 'select Is_Admin from table_6_frm where table_6_id=' . '\'' . $userid . '\'';
	$rows = getResultArray ( $con, $sql );
	$fieldtype = $rows [0] [0];
	return $fieldtype;
}

function getUserName() {
	$username = "";		
	if (isset ( $_SESSION [getAppId () . 'username'] )) {
	$username = $_SESSION [getAppId () . 'username'];
	}	
	return $username;
}

function isSaasApp() {
	$issaas = $_SESSION ['issaas'] == 'true';
	return $issaas;
}
function isOpenIdLogin() {
	$isopenid = $_SESSION ['isopenidlogin'] == '1';
	return $isopenid;
}
function encode_String($str) {
	return base64_encode ( $str );
}
function decode_String($str) {
	return base64_decode ( $str );
}
function clearTransactionCount() {
	$_SESSION ['transactioncount'] = 0;
}
function getTransactionCount() {
	if(isset($_SESSION ['transactioncount'])){
	return $_SESSION ['transactioncount'];	
	}else{
		return 0;
	}	
}
function addTransactionCount() {
	if(isset($_SESSION ['transactioncount'])){
	$_SESSION ['transactioncount'] = $_SESSION ['transactioncount'] + 1;
	}else{
	$_SESSION ['transactioncount'] =1;
	}
}
function subTransactionCount() {
	if(isset($_SESSION ['transactioncount'])){
	$_SESSION ['transactioncount'] = $_SESSION ['transactioncount'] - 1;
	}else{
	$_SESSION ['transactioncount'] =0;
	}
}
function setDataSyncTransactionId($con) {
	$tablemaxid = getMaxIdValue ( $con, "syncdetailtable", "maxsynctableid" );
	$synctablename = "datasyncquerydetails";
	if ($tablemaxid != 0) {
		$synctablename = $tablemaxid . "_" . $synctablename;
	}
	$trnextid = getNextIdValue ( $con, $synctablename, "transactionid" );
	$_SESSION ['transid'] = $trnextid;
}
function getDataSyncTransactionId() {
	return $_SESSION ['transid'];
}
function startTransaction($con) {
	$co = getTransactionCount ();
	if ($co > 0) {
		displaylogmsg ( 'STRATING  TRANSACTION Failed>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>' . $co );
		// addTransactionCount();
		return false;
	}
	displaylogmsg ( 'STRATING  TRANSACTION>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>' . $co );
	$con->beginTransaction ();
	addTransactionCount ();
}
function commitTransaction($con) {
	$co = getTransactionCount ();
	if ($co == 0) {
		displaylogmsg ( 'No Active Transactions to commit>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>' . $co );
		return false;
	}
	subTransactionCount ();
	displaylogmsg ( 'COMMITING  TRANSACTION>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>' . $co );
	$con->commit ();
}
function rollbackTransaction($con) {
	$co = getTransactionCount ();
	if ($co == 0) {
		displaylogmsg ( 'No Active Transactions to rollback>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>' . $co );
		return false;
	}
	subTransactionCount ();
	displaylogmsg ( 'ROLLBACK  TRANSACTION>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>' . $co );
	$con->rollback ();
}
function getConfigLinkInfo($con, $values) {
	$formname = $values->{OPERATIONTYPE::$FORMNAME};
	// $subformname = $values->{"subtableformname"};
	$tableid = $values->{'tableid'};
	// $sql = "select ffr.formname from formfieldreference ffr
	// left join formtable ft on ffr.refformname = ft.formname
	// left join formrelationtable frt on frt.relationid=ffr.relationid
	// where ffr.formname= '$subformname' and ffr.refformname='$formname' and ft.issubtablealone = 1 and frt.relation='n-1';";
	// $relformnames = getResultArray($con, $sql);
	// $formcount = sizeof($relformnames);
	// $linkname = '';
	// $relformname = '';
	// $returnresponse = array();
	// $linkresponse = array();
	// for ($formindex = 0; $formindex < $formcount; $formindex++) {
	// $relrow = $relformnames[$formindex];
	// $nth = findNthInstance($con, $relrow[0], $formname);
	// $refsql = "select $relrow[0]" . '_id' . " from " . $nth . $formname . "_" . $relrow[0] . "_frm where $formname" . "_id='$tableid'";
	// $returnarr = getResultArray($con, $refsql);
	// $arrCount = sizeof($returnarr);
	// for ($rowarrindex = 0; $rowarrindex < $arrCount; $rowarrindex++) {
	// $reltableid = ($returnarr[$rowarrindex]);
	// $linksql = "select * from $relrow[0]" . "_frm where $relrow[0]_id=$reltableid[0]";
	// $linkArr = getResultArray($con, $linksql);
	// $linkCount = sizeof($linkArr);
	// for ($arrindex = 0; $arrindex < $linkCount; $arrindex++) {
	// $linkrow = ($linkArr[$arrindex]);
	// $linkrowArr = array();
	// $linkrowArr[] = $linkrow;
	// $linkrowArr[] = $relrow[0];
	// $linkresponse[] = $linkrowArr;
	// }
	// }
	// }
	// $formidname = $formname . '_id';
	// $condifield = $formidname . "=\"$tableid\"";
	// setError('');
	$returnresponse [] = $linkresponse;
	$assigneduseridandroleid = '';
	try {
		$roleidname = UserFieldNames::$ROLE_ID_NAME;
		$nthofassignedto = getNthinstanceForAssignedTo ( $con, $formname );
		if ($nthofassignedto != - 1) {
			$assigneduseridsql = 'select u.table_6_id, u.' . $roleidname . ' from ' . $formname . '_frm t
                left join table_6_frm u on t.table_6_' . $nthofassignedto . '_table_6_id = u.table_6_id where t.' . $formname . '_id=\'' . $tableid . '\';';
			$assigneddbrows = getResultArray ( $con, $assigneduseridsql );
			$assigneduseridandroleid = $assigneddbrows [0];
			$cassigneduseridsql = 'select u.table_6_id, u.' . $roleidname . ' from ' . $formname . '_frm t
                left join table_6_frm u on t.table_6_0_table_6_id = u.table_6_id where t.' . $formname . '_id=\'' . $tableid . '\';';
			$cassigneddbrows = getResultArray ( $con, $cassigneduseridsql );
			//$csql = "select u.table_6_id, u.$roleidname from table_6_frm u where u.table_6_id='$userid'";
			//$cassigneddbrows = getResultArray ( $con, $csql );
			$cassigneduseridandroleid = $cassigneddbrows [0];
			$loginusername = getUserName ();
			$profile = getUserProfile ( $con, $loginusername );
			if ($profile == UserDetails::$SUPER_ADMIN_PROFILE_NAME || $formname == 'table_6') {
				$returnresponse [] = '1';
			} else {
				$returnresponse [] = getDataSharingRules ( $con, $formname, $assigneduseridandroleid, $cassigneduseridandroleid );
			}
		}
	} catch ( Exception $e ) {
		displaylogmsg ( "EXCEPTION : " . $e );
		$returnresponse [] = '1';
	}
	return $returnresponse;
}
function updateBaseFormSubtableField($con, $baseform, $refform, $nth, $baseid, $subids) {
	$subtablename = $nth . $baseform . "_" . $refform . "_frm";
	$baseformid = $baseform . "_id";
	$refformid = $refform . "_id";
	if ($baseid == "") {
		$sql = ' select ' . $refformid . ',' . $baseformid . ' from ' . $subtablename . ' where ' . $baseformid . ' in (select ' . $baseformid . ' from ' . $subtablename . '  where ' . $refformid . ' in (\'' . $subids . '\')) group by '.$refformid;
		$dbrows = getResultArray ( $con, $sql );
		$linkedidlist = "";
		$baseid = $dbrows [0] [1];
	} else {
		$sql = ' select ' . $refformid . ' from ' . $subtablename . ' where ' . $baseformid . ' = ' . '\'' . $baseid . '\'' . ' group by '.$refformid;
		$dbrows = getResultArray ( $con, $sql );
	}
	$linkedidlist = "";
	for($bi = 0; $bi < sizeof ( $dbrows ); $bi ++) {
		$linkedid = $dbrows [$bi] [0];
		if ($linkedid != "")
			$linkedidlist .= $linkedid . ",";
	}
	if ($baseform != "table_6" && $refform != "table_6") {
		if ($linkedidlist == "")
			$linkedidlist = null;
		$currenttime = date ( 'Y-m-d H:i:s' );
		$userid = getUserId ( $con );
		$sql = 'update ' . $baseform . '_frm set `' . $nth . $refformid . '` = ' . '\'' . $linkedidlist . '\',table_6_1_table_6_id=\'' . $userid . '\', updatedon = \'' . $currenttime . '\' where ' . $baseformid . ' = \'' . $baseid . '\'';
		$result = execSQL ( $con, $sql );
		insertSyncQueryDetails ( $con, $baseform . "_frm", $baseid, DB_ACTION::$UPDATE, $sql );
	}
}
function getMacroLiveRecordDetails($con, $formname) {
	$formlabelname = getFormlableName ( $con, $formname );
	$sql = "SELECT formname,conditionstr FROM liverecordconfigtable where conditionstr like '%$" . $formlabelname . "$%' and isWebOrMobile in ('2','1')";
	$dbrows = getResultArray ( $con, $sql );
	$response = Array ();
	if (sizeof ( $dbrows ) > 0) {
		$response [] = $dbrows [0] [0];
		$response [] = $dbrows [0] [1];
	}
	return $response;
}
function linkToBaseMultipleRecords($con, $obj) {
	$mformname = $obj->{'masterformname'};
	$bformname = $obj->{'baseformname'};
	$bformid = $obj->{'baseformid'};
	$sformname = $obj->{'subformname'};
	$sformids = $obj->{'subformid'};
	debug ( "SUBTABLE IDS ############ $sformids" );
	$inpfields->{$sformname . "_id"} = $sformids;
	debug ( "SUBTABLE IDS ############ $inpfields" );
	$linktype = $obj->{'linktype'};
	$relationid = $obj->{'relationid'};
	$inputfields = $obj->{'FORM_INPUTFIELDS'};
	setDataSyncTransactionId ( $con );
	$modulename = getModulename ( $con, $sformname );
	$nth = findNthInstance ( $con, $bformname, $sformname );
	$formtablename = $nth . $bformname . '_' . $sformname . '_frm';
	$displayfieldname = getDisplayFieldName ( $con, $bformname );
	if ($linktype == 'one to one link mapping') {
		$baseforms = getBaseForms ( $con, $sformname );
		$bsize = sizeof ( $baseforms );
		for($index = 0; $index < $bsize; $index ++) {
			$nformtablename = $baseforms [$index] . '_' . $sformname . '_frm';
			$dsql = 'delete from ' . $nformtablename . ' where ' . $sformname . '_id=' . '\'' . $sformid . '\'';
			$result = execSQL ( $con, $dsql );
		}
	}
	$baseformid = $bformname . '_id';
	$sformnameid = $sformname . '_id';
	$srelationdetail = findRevRelationDetail ( $con, $bformname, $sformname, $relationid );
	$bformid = trim ( $bformid );
	$subidstr = "";
	for($index = 0; $index < sizeof ( $sformids ); $index ++) {
		$subidstr = $subidstr . "'" . trim ( $sformids [$index] ) . "',";
	}
	$subidstr = lastchartrim ( $subidstr );
	if ($subidstr != "" && $bformid != "") {
		$sql = ' select ' . $sformnameid . ' from ' . $formtablename . ' where ' . $baseformid . ' = ' . '\'' . $bformid . '\'' . ' and ' . $sformnameid . ' in (' . $subidstr . ')';
		$dbrows = getResultArray ( $con, $sql );
		$insertstr = "";
		$revinsertstr = "";
		$existsids = array ();
		for($i = 0; $i < sizeof ( $dbrows ); $i ++) {
			$existsids [] = $dbrows [$i] [0];
		}
		for($i = 0; $i < sizeof ( $sformids ); $i ++) {
			if (! in_array ( $sformids [$i], $existsids )) {
				$insertstr = $insertstr . '(\'' . $bformid . '\',\'' . $sformids [$i] . '\'),';
				$revinsertstr = $revinsertstr . '(\'' . $sformids [$i] . '\',\'' . $bformid . '\'),';
			}
		}
		$insertstr = lastchartrim ( $insertstr );
		$revinsertstr = lastchartrim ( $revinsertstr );
		if ($insertstr != "") {
			$sql = 'insert into `' . $formtablename . '`  values ' . $insertstr . ';';
			$result = execSQL ( $con, $sql );
			insertSyncQueryDetails ( $con, $formtablename, "", DB_ACTION::$SUB_TABLE_INSERT, $sql );
		}
		
		updateBaseFormSubtableField ( $con, $bformname, $sformname, $nth, $bformid, $subidstr );
		addInventoryProductLink ( $con, $mformname, $bformname, $sformname, $nth, $bformid, $sformid );
		
		if (substr ( $srelationdetail [5], 2, 1 ) == '1') {
			$snth = $srelationdetail [2];
			$currenttime = date ( 'Y-m-d H:i:s' );
			$updatesql = ' update ' . $sformname . '_frm set ' . $bformname . '_' . $snth . '_' . $bformname . '_id =\'' . $bformid . '\', updatedon = \'' . $currenttime . '\' where ' . $sformname . '_id in (' . $subidstr . ');';
			$result = execSQL ( $con, $updatesql );
			if ($bformname != "table_6") {
				insertSyncQueryDetails ( $con, $sformname . "_frm", "", DB_ACTION::$UPDATE, $updatesql );
			}
		} else {
			$snth = $srelationdetail [2];
			$updatesql = 'insert into `' . $snth . $sformname . '_' . $bformname . '_frm` values ' . $revinsertstr . ';';
			$result = execSQL ( $con, $updatesql );
			insertSyncQueryDetails ( $con, $snth . $sformname . '_' . $bformname . '_frm', "", DB_ACTION::$SUB_TABLE_INSERT, $updatesql );
			updateBaseFormSubtableField ( $con, $sformname, $bformname, $snth, $sformid, '\'' . $bformidstr . '\'' );
		}
		if ($modulename == 'Inventory') {
			updateStockDetails ( $con, $sformname, $sformid, getQty ( $con, $sformname, $sformid ), false );
		}
	//	processSubtableTrigger ( $con, $obj, $bformname, $sformname, $bformid, $sformids, $inputfields );
		$inputformfields = '';
	//	processFormTrigger ( $con, $inputformfields, $sformids, $modulename, $sformname, "Update", $triggercondition );
	}
	$qrysql = 'SELECT t.*, c.*, s.* FROM newtriggertable t
    left join triggersystemactiontable ts on t.triggerid = ts.triggerid
    left join triggerconditiontable tc on t.triggerid = tc.triggerid
    left join newsystemactiontable s on ts.systemactionid = s.systemactionid
    left join newconditiontable c on tc.conditionid = c.conditionid
    where t.formname=' . '\'' . $bformname . '\'' . ' and ( t.onaction not in (' . '\'' . 'Enter' . '\'' . ',' . '\'' . 'Subtable Save' . '\'' . ') and t.status = ' . '\'' . 'Active' . '\'' . ' and t.onaction=' . '\'' . 'Add' . '\'' . '  or t.onaction = ' . '\'' . 'Add/Update' . '\'' . ') and ( t.formname=' . '\'' . $bformname . '\'' . ' and t.status = ' . '\'' . 'Active' . '\'' . ' and (s.typeofaction = ' . '\'' . 'Update' . '\'' . ' or s.typeofaction = ' . '\'' . 'Subtable Update' . '\'' . ')) order by t.triggerorder, ts.triggerorder, tc.triggerorder;';
	$triggerdetails = array();//getResultArray ( $con, $qrysql ); 
	$numtriggers = sizeof ( $triggerdetails );	
	$previoustriggerresults = array ();
	$fieldvalues = array ();
	for($ti = 0; $ti < $numtriggers; $ti++) {
		$triggerdetail = $triggerdetails [$ti];
		$triggerdetail[29]=html_entity_decode ($triggerdetail[29]);
		$triggerorder = $ti;
		$previoustriggerresults [$triggerorder] = processtriggerentry ( $con, $bformname, $inputformfields, $inputfields, $previoustriggerresults, $triggerdetail, $fieldvalues, $triggercondition, false, "" );
	}
	$invcategoryformname = getFormNamefromLableForInventory ( $con, 'Product Category' );
	if ($bformname == $invcategoryformname) {
		createInvMatrixtable ( $con, $obj );
	}
}
function getQty($con, $formname, $id) {
	$invhash = prepareInventoryFormnameHash ( $con );
	if ($formname == $invhash [INVENTORY_ENTITYLABELNAME::$PO_LINEITEM] || $formname == $invhash [INVENTORY_ENTITYLABELNAME::$MRN_LINEITEM] || $formname == $invhash [INVENTORY_ENTITYLABELNAME::$SO_LINEITEM] || $formname == $invhash [INVENTORY_ENTITYLABELNAME::$DC_LINEITEM] || $formname == $invhash [INVENTORY_ENTITYLABELNAME::$PR_LINEITEM] || $formname == $invhash [INVENTORY_ENTITYLABELNAME::$SR_LINEITEM] || $formname == $invhash [INVENTORY_ENTITYLABELNAME::$STOCKIN_LINEITEM] || $formname == $invhash [INVENTORY_ENTITYLABELNAME::$STOCKOUT_LINEITEM] || $formname == $invhash [INVENTORY_ENTITYLABELNAME::$MREJ_LINEITEM]) {
		$fieldnamestr = 'qty';
		if ($formname == $invhash [INVENTORY_ENTITYLABELNAME::$MRN_LINEITEM] || $formname == $invhash [INVENTORY_ENTITYLABELNAME::$DC_LINEITEM]) {
			$fieldnamestr = 'Delivered_Qty';
		} else if ($formname == $invhash [INVENTORY_ENTITYLABELNAME::$PR_LINEITEM]) {
			$fieldnamestr = 'Qty_Return';
		}
		$sql = 'select ' . $fieldnamestr . ' from ' . $formname . '_frm where ' . $formname . '_id = ' . '\'' . $id . '\'';
		$dbrows = getResultArray ( $con, $sql );
	}
	return $dbrows [0] [0];
}
function addInventoryProductLink($con, $mformname, $bformname, $sformname, $nth, $bformid, $sformid) {
	$labelname = getFormlableName ( $con, $bformname );
	if ($labelname == 'PO Product Line Item') {
		$mformlabelname = getFormlableName ( $con, $mformname );
		if ($mformlabelname == 'Purchase Order') {
			$bid = substr ( $sformname, 0, 1 );
			$productcategoryformname = getFormNamefromLableForInventory ( $con, 'Product Category' );
			$categorydetails = getFormNamefromLableForInventory ( $con, 'Category Details' );
			$sql = 'SELECT ' . $categorydetails . '_id FROM 0' . $productcategoryformname . '_' . $categorydetails . '_frm where ' . $productcategoryformname . '_id = ' . '\'' . $bid . '\'' . ' order by ' . $categorydetails . '_id';
			$sformids = getResultArray ( $con, $sql );
			for($sfi = 0; $sfi < sizeof ( $sformids ); $sfi ++) {
				$sids = $sids . '\'' . $sformids [$sfi] [0] . '\'' . ',';
			}
			$sids = lastchartrim ( $sids );
			if ($sids == '') {
				$sids = '\'' . '-1' . '\'';
			}
			$sql = 'select Category_Name from ' . $categorydetails . '_frm where ' . $categorydetails . '_id in (' . $sids . ')';
			$categorynames = getResultArray ( $con, $sql );
			$selectstr = '';
			for($i = 0; $i < sizeof ( $categorynames ); $i ++) {
				$categorylabelname = $categorynames [$i] [0];
				$categname = str_replace ( ' ', '_', $categorylabelname );
				$selectstr .= $categname . ',';
			}
			$selectstr = lastchartrim ( $selectstr );
			$productformname = getFormNamefromLableForInventory ( $con, 'Product' );
			$productformid = $productformname . '_' . $nth . '_' . $productformname . '_id';
			$baseformtablename = $bformname . '_frm';
			$sql = 'select ' . $productformid . ' from ' . $baseformtablename . ' where ' . $bformname . '_id=' . $bformid . ';';
			$produtidarr = getResultArray ( $con, $sql );
			$productid = $produtidarr [0] [0];
			$sql = 'select ' . $selectstr . ' from ' . $sformname . '_frm where ' . $sformname . '_id = ' . '\'' . $sformid . '\'';
			$scaterows = getResultArray ( $con, $sql );
			$conditionstr = ' where ';
			for($i = 0; $i < sizeof ( $categorynames ); $i ++) {
				$categorylabelname = $categorynames [$i] [0];
				$categname = str_replace ( ' ', '_', $categorylabelname );
				$conditionstr .= $categname . ' = \'' . $scaterows [0] [$i] . '\'';
				$j = $i;
				if (++ $j < sizeof ( $categorynames )) {
					$conditionstr .= ' and ';
				}
			}
			$sql = 'select ' . $sformname . '_id from ' . $sformname . '_frm ' . $conditionstr . ' and ' . $sformname . '_id != ' . '\'' . $sformid . '\'';
			$srows = getResultArray ( $con, $sql );
			$createlink = false;
			$prolinkformname = $nth . $productformname . '_' . $sformname . '_frm';
			if (sizeof ( $srows ) > 0) {
				$sid = $srows [0] [0];
				$sql = 'select * from ' . $prolinkformname . ' where ' . $productformname . '_id=' . '\'' . $productid . '\'' . ' and ' . $sformname . '_id=' . '\'' . $sid . '\'';
				$dbrows = getResultArray ( $con, $sql );
				if (sizeof ( $dbrows ) == 0) {
					$createlink = true;
				}
			} else {
				$createlink = true;
			}
			if ($createlink) {
				$sql = 'insert into ' . $prolinkformname . ' values(' . '\'' . $productid . '\'' . ',' . '\'' . $sformid . '\'' . ')';
				$result = execSQL ( $con, $sql );
			}
		}
	}
}
function getProductTitle($con, $productid) {
	$sql = "select title from " . DBINFO::$COMMONDBNAME . ".saasconfig where productid='$productid';";
	$retarr = getResultArray ( $con, $sql );
	return $retarr [0] [0];
}
function linkToBase($con, $obj) {
	$mformname = $obj->{'masterformname'};
	$bformname = $obj->{'baseformname'};
	$bformid = $obj->{'baseformid'};
	$sformname = $obj->{'subformname'};
	$sformid = $obj->{'subformid'};
	$inpfields->{$sformname . "_id"} = $sformid;
	$linktype = $obj->{'linktype'};
	$relationid = $obj->{'relationid'};
	$inputfields = $obj->{'FORM_INPUTFIELDS'};
	$nth = findNthInstance ( $con, $bformname, $sformname );
	$formtablename = $nth . $bformname . '_' . $sformname . '_frm';
	$displayfieldname = getDisplayFieldName ( $con, $bformname );
	setDataSyncTransactionId ( $con );
	if ($linktype == 'one to one link mapping') {
		$baseforms = getBaseForms ( $con, $sformname );
		$bsize = sizeof ( $baseforms );
		for($index = 0; $index < $bsize; $index ++) {
			$nformtablename = $baseforms [$index] . '_' . $sformname . '_frm';
			$dsql = 'delete from ' . $nformtablename . ' where ' . $sformname . '_id=' . '\'' . $sformid . '\'';
			$result = execSQL ( $con, $dsql );
		}
	}
	$baseformid = $bformname . '_id';
	$sformnameid = $sformname . '_id';
	$sql = ' select * from ' . $formtablename . ' where ' . $baseformid . ' = ' . '\'' . $bformid . '\'' . ' and ' . $sformnameid . ' = ' . '\'' . $sformid . '\'';
	$dbrows = getResultArray ( $con, $sql );
	if (sizeof ( $dbrows ) == 0) {
		$sql = 'insert into `' . $formtablename . '`  values(' . '\'' . $bformid . '\'' . ',' . '\'' . $sformid . '\'' . ');';
		$result = execSQL ( $con, $sql );
		insertSyncQueryDetails ( $con, $formtablename, "", DB_ACTION::$SUB_TABLE_INSERT, $sql );
		addInventoryProductLink ( $con, $mformname, $bformname, $sformname, $nth, $bformid, $sformid );
	}
	updateBaseFormSubtableField ( $con, $bformname, $sformname, $nth, $bformid, '\'' . $sformid . '\'' );
	$displaysql = 'select ' . $displayfieldname . ' from ' . $bformname . '_frm where ' . $bformname . '_id=' . '\'' . $bformid . '\'';
	$retArr = getResultArray ( $con, $displaysql );
	if (sizeof ( $retArr ) > 0) {
		$row = $retArr [0];
		$refname = $row [0];
		$updatesql = 'update ' . $sformname . '_frm set Related_to=' . '\'' . $refname . '\'' . ' where ' . $sformname . '_id=' . '\'' . $sformid . '\'';
		// $result = execSQL($con, $updatesql);
		
		$srelationdetail = findRevRelationDetail ( $con, $bformname, $sformname, $relationid );
		if (substr ( $srelationdetail [5], 2, 1 ) == '1') {
			$snth = $srelationdetail [2];
			$currenttime = date ( 'Y-m-d H:i:s' );
			$updatesql = ' update ' . $sformname . '_frm set ' . $bformname . '_' . $snth . '_' . $bformname . '_id =\'' . $bformid . '\', updatedon = \'' . $currenttime . '\' where ' . $sformname . '_id in (' . $sformid . ');';
			$result = execSQL ( $con, $updatesql );
			insertSyncQueryDetails ( $con, $sformname . "_frm", "", DB_ACTION::$UPDATE, $updatesql );
		} else {
			$snth = $srelationdetail [2];
			$updatesql = 'insert into `' . $snth . $sformname . '_' . $bformname . '_frm` values (\'' . $sformid . '\', \'' . $bformid . '\');';
			$result = execSQL ( $con, $updatesql );
			insertSyncQueryDetails ( $con, $snth . $sformname . '_' . $bformname . '_frm', "", DB_ACTION::$SUB_TABLE_INSERT, $updatesql );
			updateBaseFormSubtableField ( $con, $sformname, $bformname, $snth, $sformid, '\'' . $bformid . '\'' );
		}
		$sformids = array ();
		$sformids [] = $sformid;
		processSubtableTrigger ( $con, $obj, $bformname, $sformname, $bformid, $sformids, $inputfields );
		$inputformfields = '';
		$modulename = getModulename ( $con, $sformname );
		processFormTrigger ( $con, $inputformfields, $inpfields, $modulename, $sformname, "Update", $triggercondition );
	}
	$formnameandlablenames = prepareInventoryFormnameHash ( $con );
	$invcategoryformname = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PRODUCTCATEGORY];
	if ($bformname == $invcategoryformname) {
		alterInvMatrixTable ( $con, $obj );
	}
	insertSubtableHistoryDetails ( $con, $obj );
}
function getDisplayFieldName($con, $formname) {
	$sql = 'select name from formfieldtable where formname = ' . '\'' . $formname . '\'' . ' and isdisplay=' . '\'' . '1' . '\'';
	$retarr = getResultArray ( $con, $sql );
	$fieldorder = 1;
	if (sizeof ( $retarr ) > 0) {
		$row = $retarr [0];
		$fieldorder = $row [0];
	} else {
		$sql = 'select name from formfieldtable where formname = ' . '\'' . $formname . '\'' . ' and fieldorder=' . '\'' . '1' . '\'';
		$retarr = getResultArray ( $con, $sql );
		if (sizeof ( $retarr ) > 0) {
			$row = $retarr [0];
			$fieldorder = $row [0];
		}
	}
	return $fieldorder;
}
function processNextPage($con, $values) {
	$formname = $values->{OPERATIONTYPE::$FORMNAME};
	$searchtext = $values->{OPERATIONTYPE::$SEARCHFIELDS};
	$subtable = FieldType::$SUBTABLE;
	$fieldsql = 'SELECT f.name,ft.formname FROM formfieldtable f,formtable ft where ft.formname=' . '\'' . $formname . '\'' . ' and ft.formname=f.formname and f.type <>' . '\'' . $subtable . '\'' . ';';
	$fields = getResultArray ( $con, $fieldsql );
	$fieldCount = sizeof ( $fields );
	$sql = 'select ';
	$whereCond = ' where ';
	$formtablename = '';
	for($fieldindex = 0; $fieldindex < $fieldCount; $fieldindex ++) {
		if ($fieldindex != 0) {
			$sql .= ',';
			$whereCond .= ' or ';
		}
		$sql .= $fields [$fieldindex] [0];
		$formtablename = $fields [$fieldindex] [1];
		$whereCond .= $fields [$fieldindex] [0] . ' like ' % $searchtext % '';
	}
	if (strpos ( $formtablename, 'table_' ) === false) {
		// this is a normal table
	} else {
		$formtablename .= '_frm';
	}
	$sql .= ' from ' . $formtablename . $whereCond;
	$countsql = 'select count(1) from ' . $formtablename . $whereCond;
	$dbrows = getResultArray ( $con, $sql );
	$pagenumber = $obj->{OPERATIONTYPE::$PAGENUMBER};
	return getArrayWithLimit ( $con, $values, $sql, $pagenumber, $dbrows [0] [0], false );
}
function reCreateSearchString($con, $response, $modulename, $formname) {
	$PATTERN2 = '#';
	$PATTERN3 = '@';
	$SPACE_PATTERN = ' ';
	$keyvaluepair = explode ( $PATTERN2, $response );
	$keyCount = sizeof ( $keyvaluepair );
	$newSearchString = '';
	for($keyindex = 0; $keyindex < $keyCount; $keyindex ++) {
		$formFields = explode ( $PATTERN3, $keyvaluepair [$keyindex] );
		$formFieldCount = sizeof ( $formFields );
		$newKeyCount = $keyCount - 1;
		if ($formFieldCount == 6) {
			$columntype = $formFields [0];
			$tablename = $formFields [1];
			$columnname = $formFields [2];
			$operator = $formFields [3];
			$fieldVal = $formFields [4];
			$condop = $formFields [5];
			if ($tablename != $formname) {
				$reftablename = substr ( $tablename, 0, strlen ( $tablename ) - 2 );
				$sql = 'select fieldname from formfieldreference where refformname=' . '\'' . $reftablename . '\'' . ' and reffieldname=' . '\'' . $columnname . '\'' . ' and modulename=' . '\'' . $modulename . '\'' . ' and formname = ' . '\'' . $formname . '\'' . ' and fieldname like ' . '\'' . $tablename . '%' . '\'';
				$retArr = getResultArray ( $con, $sql );
				if (sizeof ( $retArr ) > 0) {
					$row = $retArr [0];
					$tablename = $formname;
					$columnname = $row [0];
					$string = $columntype . $PATTERN3 . $tablename . $PATTERN3 . $columnname . $PATTERN3 . $operator . $PATTERN3 . $fieldVal . $PATTERN3 . $condop;
					$newSearchString .= $string . $PATTERN2;
				}
			} else {
				$newSearchString .= $keyvaluepair [$keyindex] . $PATTERN2;
			}
		}
	}
	return $newSearchString;
}
function processSaveTemplate($con, $obj) {
	$operation = $obj->{OPERATIONTYPE::$KEY};
	$currenttime = date('Y-m-d H:i:s');
	$templatename = $obj->{'Template name'};
	$templateid = $obj->{'Template Id'};
	$forsearchtemplate = $obj->{'forsearchtemplate'};
	$ishideinview = $obj->{'ishideinview'};
	if ($forsearchtemplate == "true") {
		$forsearchtemplate = "1";
	} else {
		$forsearchtemplate = "0";
	}
	if ($ishideinview == "true") {
		$ishideinview = "1";
	} else {
		$ishideinview = "0";
	}
	$formname = $obj->{'FORMNAME'};
	$username = getUserName ();
	$modulename = $obj->{'MODULENAME'};
	if ($forsearchtemplate == "1") {
		$sql = "update searchtemplate set forsearchtemplate = '0' where formname = '$formname'";
		$result = execSQL ( $con, $sql );
	}
	$match = array (
			"'",
			'"' 
	);
	$replace = array (
			"\'",
			'\"' 
	);
	$templatename = str_replace ( $match, $replace, $templatename );
	$desc = "";
	$ismobilefieldschanged = false;
	if ($operation == OPERATIONTYPE::$FIND) {
		$sql = 'select searchfields from searchtemplate where templatename=\'' . $templatename . '\' and formname=\'' . $formname . '\' and  templateid = ' . '\'' . $templateid . '\'' . ';';
	} else if ($operation == OPERATIONTYPE::$SAVE) {
		$searchFields = $obj->{'SEARCHFIELDS'};
		$fieldLength = sizeof ( $searchFields );
		$viewfields = $obj->{'viewfields'};
		$mviewfields = $obj->{'mobileviewfields'};
		$accesspermission = $obj->{'access_rights'};
		$templateid = getNextIdValue ( $con, "searchtemplate", "templateid" );
		$issystem = $obj->{'issystem'};
		if ($issystem == "true") {
			$issystem = "1";
		} else if ($issystem == "false") {
			$issystem = "0";
		}
		$ismobile = $obj->{'ismobile'};
		if ($ismobile == "true") {
			$ismobile = "1";
		} else if ($ismobile == "false") {
			$ismobile = "0";
		}
		$isdefaultmobile = "0";
		if ($ismobile == "1") {
			$isdefaultmobile = $obj->{'isdefaultmobile'};
			if ($isdefaultmobile == "true") {
				$isdefaultmobile = "1";
			} else if ($isdefaultmobile == "false") {
				$isdefaultmobile = "0";
			}
		}
		$sql = 'insert into searchtemplate (templateid,templatename,formname,username,searchfields,modulename,access_rights,viewfields, issystem,ismobile,ismobiledefault,mobileviewfields,forsearchtemplate,ishideinview,updatedon) values (' . '\'' . $templateid . '\'' . ', ' . '\'' . $templatename . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . $username . '\'' . ',' . '\'' . $searchFields . '\'' . ',' . '\'' . $modulename . '\'' . ',' . '\'' . $accesspermission . '\'' . ', ' . '\'' . $viewfields . '\'' . ', ' . '\'' . $issystem . '\'' . ', ' . '\'' . $ismobile . '\'' . ',\'' . $isdefaultmobile . '\'' . ',\'' . $mviewfields . '\'' . ',\'' . $forsearchtemplate . '\',\'' . $ishideinview . '\',\'' . $currenttime . '\')';
		saveLastSelectedTemplate ( $con, $obj, $formname, $templatename, $templateid );
		$response [] = $templateid;
		$desc = $formname . "/" . $templateid;
	} else if ($operation == 'SaveLastTemplateList') {
		return saveLastSelectedTemplate ( $con, $obj, $formname, $templatename, $templateid );
	} else if ($operation == OPERATIONTYPE::$EDIT) {
		$searchFields = $obj->{'SEARCHFIELDS'};
		$viewfields = $obj->{'viewfields'};
		$mviewfields = $obj->{'mobileviewfields'};
		$origtemplatename = $obj->{'orig_template'};
		$origtemplatename = str_replace ( $match, $replace, $origtemplatename );
		$accesspermission = $obj->{'access_rights'};
		$issystem = $obj->{'issystem'};
		if ($issystem == "true") {
			$issystem = "1";
		} else if ($issystem == "false") {
			$issystem = "0";
		}
		$ismobile = $obj->{'ismobile'};
		if ($ismobile == "true") {
			$ismobile = "1";
		} else if ($ismobile == "false") {
			$ismobile = "0";
		}
		$isdefaultmobile = "0";
		if ($ismobile == "1") {
			$isdefaultmobile = $obj->{'isdefaultmobile'};
			if ($isdefaultmobile == "true") {
				$isdefaultmobile = "1";
			} else if ($isdefaultmobile == "false") {
				$isdefaultmobile = "0";
			}
		}
		$tempsql = 'select issystem,ismobile,mobileviewfields,username,searchfields,templatename,access_rights,ismobiledefault from searchtemplate where formname=\'' . $formname . '\' and templateid = ' . '\'' . $templateid . '\'' . ';';
		$dbrows = getResultArray ( $con, $tempsql );
		for($i = 0; $i < sizeof ( $dbrows [0] ); $i ++) {
			$templatefields .= $dbrows [0] [$i];
		}
		$condstr = $issystem . $ismobile . $mviewfields . $username . $searchFields . $templatename . $accesspermission . $isdefaultmobile;
		if (sizeof ( $dbrows ) > 0) {
			if ($templatefields != $condstr) {
				$ismobilefieldschanged = true;
			}
		} else if ($mviewfields != '') {
			$ismobilefieldschanged = true;
		}
		$fieldLength = sizeof ( $searchFields );
		$sql = 'update searchtemplate set issystem=' . '\'' . $issystem . '\'' . ',ismobile=' . '\'' . $ismobile . '\'' . ', viewfields=\'' . $viewfields . '\', mobileviewfields=\'' . $mviewfields . '\', username=\'' . $username . '\', searchfields=\'' . $searchFields . '\',templatename=\'' . $templatename . '\',access_rights=\'' . $accesspermission . '\',ismobiledefault=\'' . $isdefaultmobile . '\',forsearchtemplate=\'' . $forsearchtemplate . '\',ishideinview=\'' . $ishideinview . '\',updatedon=\'' . $currenttime . '\' where templatename=\'' . $origtemplatename . '\' and formname=\'' . $formname . '\'  and templateid = ' . '\'' . $templateid . '\'' . ';';
		$desc = $formname . "/" . $templateid;
		$descsql = "select ismobile from searchtemplate where formname = '$formname' and templateid = '$templateid'";
		$descrows = getResultArray ( $con, $descsql );
		if ($ismobile == "0" && $descrows [0] [0] == "1") {
			$desc = $formname . "/true";
		}
	} else if ($operation == OPERATIONTYPE::$DELETE) {
		$dsname = checkForDashBoard ( $con, $templatename );
		if ($dsname == '') {
			$delsql = 'delete from user_preference where value =\'' . $templateid . '\' and property=' . '\'' . $formname . '\'';
			$result = execSQL ( $con, $delsql );
			// insertSyncQueryDetails($con, "user_preference", "", DB_ACTION::$TEMPLATE, $delsql);
			$sql = 'delete from searchtemplate where templatename=\'' . $templatename . '\' and formname=\'' . $formname . '\'  and templateid = ' . '\'' . $templateid . '\'' . ';';
			$deldesc = $formname . "/" . $templateid;
			insertSyncQueryDetails($con, "searchtemplate", "", DB_ACTION::$TEMPLATE, $sql,"","",$deldesc);
		} else {
			$errormsg = 'You cannot delete the template ' . $templatename . ',because its used in ' . $dsname . ' dashboard!';
			setError ( $errormsg );
			return $templatename;
		}
		$descsql = "select username,access_rights from searchtemplate where formname = '$formname' and templateid = '$templateid' and ismobile = '1'";
		$descrows = getResultArray ( $con, $descsql );
		$desc = $formname . "/" . $templateid;
		if (sizeof ( $descrows ) != 0) {
			$desc = $desc . "/" . $descrows [0] [0] . "," . $descrows [0] [1];
		}
	}
	if ($operation == OPERATIONTYPE::$FIND) {
		saveLastSelectedTemplate ( $con, $obj, $formname, $templatename, $templateid );
		$result = getResultArray ( $con, $sql );
		$response = $result [0] [0];
		$response = reCreateSearchString ( $con, $response, $modulename, $formname );
	} else {
		$result = execSQL ( $con, $sql );
		if ($operation != OPERATIONTYPE::$FIND) {
			if ($operation == OPERATIONTYPE::$EDIT) {
				if ($ismobilefieldschanged) {
					setDataSyncTransactionId ( $con );
					updateFormModificationHistoryDetails($con, "searchtemplate");
					//insertSyncQueryDetails ( $con, "searchtemplate", "", DB_ACTION::$TEMPLATE, $sql, "", "", $desc );
				}
			} else {
				setDataSyncTransactionId ( $con );
				updateFormModificationHistoryDetails($con, "searchtemplate");
				//insertSyncQueryDetails ( $con, "searchtemplate", "", DB_ACTION::$TEMPLATE, $sql, "", "", $desc );
			}
		}
		if (! $result) {
			$errormsg = ServerError::$GENERAL_ERROR;
			$response = $sql;
		} else {
			if ($operation == OPERATIONTYPE::$SAVE) {
				updateFormMaxId ( $con, 'searchtemplate', $templateid );
				return $response;
			}
			if ($operation == OPERATIONTYPE::$EDIT) {
				if ($templatename != $origtemplatename) {
					$usql = 'update user_preference set value = ' . '\'' . $templateid . '\'' . ' where property = ' . '\'' . $formname . '\'' . ' and value = ' . '\'' . $origtemplatename . '\'';
					$uresult = execSQL ( $con, $usql );
					// insertSyncQueryDetails($con, "searchtemplate", "", DB_ACTION::$TEMPLATE, $usql);
				}
			}
			$response = $templatename;
		}
	}
	return $response;
}
function checkForDashBoard($con, $tempname) {
	$sql = 'select templateid from searchtemplate where templatename = ' . '\'' . $tempname . '\'';
	$result = getResultArray ( $con, $sql );
	$sql = 'select name from dashboardform where entitytype = 1 and entityid =' . '\'' . $result [0] [0] . '\'';
	$dbrow = getResultArray ( $con, $sql );
	return $dbrow [0] [0];
}
function setAppId($appid) {
	$_SESSION ['appid'] = $appid;
}
function setProductId($pid) {
	$_SESSION ['pid'] = $pid;
}
function setEditionIndex($editionindex) {
	$_SESSION ['editionindex'] = $editionindex;
}
function setCurrencySymbolNeeded($needed) {
	$_SESSION ['currencysymbolenabled'] = $needed;
}
function isCurrencySymbolNeeded() {
	if (! isset ( $_SESSION ['currencysymbolenabled'] )) {
		return false;
	}
	return $_SESSION ['currencysymbolenabled'];
}
function setUserName($con, $username) {	
	$username=mysql_escape_string($username);	
	$_SESSION [getAppId () . 'username'] = $username;
	//setUserActive ( $con, $username, 1 );
}
function saveLastSelectedTemplate($con, $obj, $formname, $templatename, $templateid) {
	$response = '';
	$username = getUserName ();
	try {
		startTransaction ( $con );
		$sql = 'select * from user_preference where property=' . '\'' . $formname . '\'' . ' and username=' . '\'' . $username . '\'';
		$response = getResultArray ( $con, $sql );
		if ((sizeof ( $response )) === 0) {
			$sql = 'insert into user_preference values(' . '\'' . $username . '\'' . ',' . '\'' . $formname . '\'' . ',' . '\'' . $templateid . '\'' . ')';
		} else {
			$sql = 'update user_preference set value=' . '\'' . $templateid . '\'' . ' where property=' . '\'' . $formname . '\'' . ' and username=' . '\'' . $username . '\'';
		}
		execSQL ( $con, $sql );
		// insertSyncQueryDetails($con, "user_preference", "", DB_ACTION::$TEMPLATE, $sql);
		commitTransaction ( $con );
	} catch ( Exception $e ) {
		rollbackTransaction ( $con );
		displaylogmsg ( 'Exception : ' . $e );
		$response = 'Error';
	}
	return $response;
}
function processLastSelectedPageNo($con, $obj) {
	$operation = $obj->{OPERATIONTYPE::$KEY};
	if ($operation == 'SaveLastPageNo') {
		return saveLastSelectedPageNoinfo ( $con, $obj );
	}
}
function isMobileForm($con, $formname) {
	$ismobile = false;
	$sql = "select * from formtable where formname = '$formname' and isapplicableformobile = '1'";
	$response = getResultArray ( $con, $sql );
	if ((sizeof ( $response )) > 0) {
		$ismobile = true;
	}
	return $ismobile;
}
function getGCMRegisterId($con, $userid) {
	$regid = array();
	$sql = "SELECT register_key,platform FROM GCM_details where userid = '$userid'";
	$response = getResultArray ( $con, $sql );
	if ((sizeof ( $response )) > 0) {
		$regid [0] = $response [0] [0];
		$regid [1] = $response [0] [1]; 
	}
	return $regid;
}
function saveLastSelectedPageNoinfo($con, $obj) {
	$username = getUserName ();
	$lastselectedTemplate = $obj->{'NoofPage'};
	$formname = $obj->{OPERATIONTYPE::$FORMNAME};
	try {
		startTransaction ( $con );
		$sql = 'select * from user_preference where property=' . '\'' . 'PageNo_' . $formname . '\'' . ' and username=' . '\'' . $username . '\'';
		$response = getResultArray ( $con, $sql );
		if ((sizeof ( $response )) > 0) {
			$sql = 'update user_preference set value=' . '\'' . $lastselectedTemplate . '\'' . ' where property=' . '\'' . 'PageNo_' . $formname . '\'' . ' and username=' . '\'' . $username . '\'';
		} else {
			$sql = 'insert into user_preference values(' . '\'' . $username . '\'' . ',' . '\'' . 'PageNo_' . $formname . '\'' . ',' . '\'' . $lastselectedTemplate . '\'' . ')';
		}
		$response = '';
		$result = execSQL ( $con, $sql );
		commitTransaction ( $con );
	} catch ( Exception $e ) {
		rollbackTransaction ( $con );
		displaylogmsg ( 'Exception : ' . $e );
	}
}
function lastchartrim($str) {
	$flen = strlen ( $str );
	if ($flen > 0) {
		$str = substr ( $str, 0, $flen - 1 );
	}
	return $str;
}
function CommonLineItemFormNames($con) {
	$formnames = array ();
	$formlablenames = array ();
	$formnameandlablenames = prepareInventoryFormnameHash ( $con );
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PO_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$PO_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$SO_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$SO_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$MREJ_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$MREJ_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$SR_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$SR_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$MRN_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$MRN_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PINVOICE_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$PINVOICE_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$SINVOICE_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$SINVOICE_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PERFINVOICE_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$PERFINVOICE_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PR_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$PR_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PRQ_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$PRQ_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$DC_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$DC_LINEITEM;
	$formnames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$QUOTE_LINEITEM];
	$formlablenames [] = INVENTORY_ENTITYLABELNAME::$QUOTE_LINEITEM;
	$catdetails = array ();
	$catdetails [] = $formnames;
	$catdetails [] = $formlablenames;
	return $catdetails;
}
function getAllFieldValuesWithCond($con, $formname, $fieldname, $wherecond) {
	$sql = 'select ' . $fieldname . ' from ' . $formname . ' ' . $wherecond . ';';
	$result = getResultSet ( $con, $sql );
	$data = array ();
	foreach ( $result as $row ) {
		$data [] = $row [0];
	}
	return $data;
}
function getFieldValuesWithCond($con, $formname, $fieldname, $wherecond) {
	$sql = 'select distinct(' . $fieldname . ') from ' . $formname . ' ' . $wherecond;
	$result = getResultSet ( $con, $sql );
	$data = array ();
	foreach ( $result as $row ) {
		$data [] = $row [0];
	}
	return $data;
}
function getFieldValues($con, $formname, $fieldname) {
	$sql = 'select distinct(' . $fieldname . ') from ' . $formname;
	$result = getResultSet ( $con, $sql );
	$data = array ();
	foreach ( $result as $row ) {
		$data [] = $row [0];
	}
	return $data;
}
function getNextIdValue($con, $formname, $fieldname) {
	$nextid = 0;
	$sql = 'select max(cast(' . $fieldname . ' as signed)) from ' . $formname . ' FOR UPDATE ; ';
	$result = getResultSet ( $con, $sql );
	foreach ( $result as $dbrow ) {
		$nextid = $dbrow [0] + 1;
	}
	return '' . $nextid;
}
function getMaxIdValue($con, $formname, $fieldname) {
	$maxid = 0;
	$sql = 'select max(cast(' . $fieldname . ' as signed)) from ' . $formname . ' FOR UPDATE ; ';
	$result = getResultSet ( $con, $sql );
	foreach ( $result as $dbrow ) {
		$maxid = $dbrow [0];
	}
	return '' . $maxid;
}
function getNextIdValueWithCond($con, $formname, $fieldname, $cond) {
	$nextid = 0;
	$sql = 'select max(' . $fieldname . ') from ' . $formname . ' where ' . $cond . ';';
	$result = getResultSet ( $con, $sql );
	foreach ( $result as $dbrow ) {
		if ($dbrow [0] != '')
			$nextid = $dbrow [0] + 1;
	}
	return '' . $nextid;
}
function getFormMaxId($con, $tablename) {
	$maxid = 0;
	$sql = 'select id from idgenerator where tablename=' . '\'' . $tablename . '\'' . ' FOR UPDATE ; ';
	$result = getResultSet ( $con, $sql );
	foreach ( $result as $dbrow ) {
		$maxid = $dbrow [0] + 1;
	}
	if ($maxid > 0) {
		$sql = 'update idgenerator set id=' . '\'' . $maxid . '\'' . ' where tablename=' . '\'' . $tablename . '\'' . '';
		$result = execSQL ( $con, $sql );
	} else {
		$maxid = $maxid + 1;
		$sql = 'insert into idgenerator value (' . '\'' . $tablename . '\'' . ', ' . '\'' . $maxid . '\'' . ');';
		$result = execSQL ( $con, $sql );
	}
	return $maxid;
}
function getAutoMaxId($con, $tablename,$fieldname) {
	$maxid = 0;
	$sql = 'select idvalue from autoprefixid where formname=' . '\'' . $tablename . '\'' . ' and fieldname=' . '\'' . $fieldname . '\'' . ' FOR UPDATE ; ';
	$result = getResultSet ( $con, $sql );
	foreach ( $result as $dbrow ) {
		$maxid = $dbrow [0] + 1;
	}
	if ($maxid > 0) {
		$sql = 'update autoprefixid set idvalue=' . '\'' . $maxid . '\'' . ' where formname=' . '\'' . $tablename . '\'' . ' and fieldname=' . '\'' . $fieldname . '\'' . ' ; ';
		$result = execSQL ( $con, $sql );
	} 
	return $maxid;
}
function getFormMaxIdForImport($con, $tablename) {
	$maxid = 0;
	$sql = 'select id from idgenerator where tablename=' . '\'' . $tablename . '\'' . ' FOR UPDATE ; ';
	$result = getResultSet ( $con, $sql );
	foreach ( $result as $dbrow ) {
		$maxid = $dbrow [0] + 1;
	}
	return $maxid;
}
function getMobileMaxId($con) {
	$mid = "AA";
	$sql = 'select maxid from mobileidgenerator FOR UPDATE ; ';
	$result = getResultArray ( $con, $sql );
	if (sizeof ( $result ) > 0) {
		$mid = $result [0] [0];
		$mid ++;
	}
	$sql = "update mobileidgenerator set maxid ='$mid'";
	execSQL ( $con, $sql );
	return $mid;
}
function updateFormMaxId($con, $tablename, $val) {
	return "";
	// $sql = 'select id from idgenerator where tablename=' . '\'' . $tablename . '\''; //. ' FOR UPDATE ; ';
	// $result = getResultArray($con, $sql);
	// if (sizeof($result) > 0) {
	// $sql = 'update idgenerator set id=' . '\'' . $val . '\'' . ' where tablename=' . '\'' . $tablename . '\'' . '';
	// $result = execSQL($con, $sql);
	// } else {
	// $sql = 'insert into idgenerator value (' . '\'' . $tablename . '\'' . ', ' . '\'' . $val . '\'' . ');';
	// $result = execSQL($con, $sql);
	// }
	// return $result;
}
function updateFormMaxIdForImport($con, $tablename, $val) {
	$sql = 'select id from idgenerator  where tablename=' . '\'' . $tablename . '\''; // . ' FOR UPDATE ; ';
	$result = getResultArray ( $con, $sql );
	if (sizeof ( $result ) > 0) {
		$sql = 'update idgenerator set id=' . '\'' . $val . '\'' . ' where tablename=' . '\'' . $tablename . '\'' . '';
		$result = execSQL ( $con, $sql );
	} else {
		$sql = 'insert into idgenerator value (' . '\'' . $tablename . '\'' . ', ' . '\'' . $val . '\'' . ');';
		$result = execSQL ( $con, $sql );
	}
	return $result;
}
function updateSaasFormMaxId($con, $appid, $nextuserid) {
	$val = $nextuserid;
	$tablename = 'table_6_frm';
	$sql = 'select id from  ' . DBINFO::$APPDBNAME . $appid . '.idgenerator  where tablename=' . '\'' . $tablename . '\'';
	$result = getResultArray ( $con, $sql );
	if (sizeof ( $result ) > 0) {
		$sql = 'update  ' . DBINFO::$APPDBNAME . $appid . '.idgenerator set id=' . '\'' . $val . '\'' . ' where tablename=' . '\'' . $tablename . '\'';
		$result = execSQL ( $con, $sql );
	} else {
		$sql = 'insert into  ' . DBINFO::$APPDBNAME . '.idgenerator value (' . '\'' . $tablename . '\'' . ', ' . '\'' . $val . '\'' . ');';
		$result = execSQL ( $con, $sql );
	}
	return $result;
}
function getFormFieldStmt($con, $modulename, $formname) {
	$formnames = array ();
	$formfield = array ();
	$formfield = getFormFielddsBasicDetail ( $con, $modulename, $formname );
	$filedlen = sizeof ( $formfield );
	$entityfieldsstr = '';
	for($fieldindex = 0; $fieldindex < $filedlen; $fieldindex ++) {
		$field = array ();
		$field = $formfield [$fieldindex];
		$field_name_index = 2;
		$fieldname = $field [$field_name_index];
		$entityfieldsstr = $entityfieldsstr . $fieldname . ',';
	}
	$entityfieldsstr = lastchartrim ( $entityfieldsstr );
	return $entityfieldsstr;
}
function getFieldValuesFor($con, $formname, $fieldnames, $fieldvalues, $orderby) {
	$formdetails = array ();
	$fnamesize = sizeof ( $fieldnames );
	$condstr = '';
	for($i = 0; $i < $fnamesize; $i ++) {
		$condstr = $condstr . $fieldnames [$i] . '=' . '\'' . $fieldvalues [$i] . '\'' . ' and ';
	}
	if ($condstr != '') {
		$condstr = lastchartrim ( $condstr );
		$condstr = lastchartrim ( $condstr );
		$condstr = lastchartrim ( $condstr );
		$condstr = lastchartrim ( $condstr );
		$condstr = ' where ' . $condstr . ' ' . $orderby . ' ';
	}
	$sql = 'select * from ' . $formname . $condstr . ';';
	$result = getResultSet ( $con, $sql );
	foreach ( $result as $row ) {
		$ncols = sizeof ( $row ) / 2;
		$formfieldrow = array ();
		for($coli = 0; $coli < $ncols; $coli ++) {
			$formfieldrow [$coli] = $row [$coli];
		}
		$formdetails [] = $formfieldrow;
	}
	return $formdetails;
}
function getResultSet($con, $sql) {
	$stmt = querySQL ( $con, $sql );
	$resultSet = $stmt->fetchAll ();
	return $resultSet;
}
function getResultAsscData($con, $sql) {
	displaysqllogmsg ( 'Sql Query : ' . $sql );
	$sth = $con->prepare ( $sql );
	$sth->execute ();
	$resultrows = array ();
	while ( $result = $sth->fetch ( PDO::FETCH_ASSOC ) ) {
		$resultrows [] = $result;
	}
	return $resultrows;
}
function startsWith($haystack, $needle) {
	$length = strlen ( $needle );
	return (substr ( $haystack, 0, $length ) === $needle);
}
function endWith($haystack, $needle) {
	$length = strlen ( $needle );
	if ($length == 0) {
		return true;
	}
	
	$start = $length * - 1; // negative
	return (substr ( $haystack, $start ) === $needle);
}
function getResultArray($con, $sql) {
	$dbrows = array ();
	$rs = querySQL ( $con, $sql );
	$rs->setFetchMode ( PDO::FETCH_NUM );
	while ( $dbrow = $rs->fetch () ) {
		$len = sizeof ( $dbrow );
		$row = array ();
		for($ri = 0; $ri < $len; $ri ++) {
			$row [] = $dbrow [$ri];
		}
		$dbrows [] = $row;
	}
	return $dbrows;
}
function getValidDBField($str) {
	$str = str_replace ( ' ', '_', $str );
	return $str;
}
function getFormTableName($formname) {
	$formtablename = $formname . BuilderKey::$TABLE_EXDENTION;
	return strtolower ( $formtablename );
}
function extractformnamefromtablename($foreigntablename) {
	$exlen = strlen ( BuilderKey::$TABLE_EXDENTION );
	$foetablelen = strlen ( $foreigntablename );
	$foreigntablename = substr ( $foreigntablename, 0, ($foetablelen - $exlen) );
	return strtolower ( $foreigntablename );
}
function getSubFormTableName($foreigntablename, $formtablename) {
	$exlen = strlen ( BuilderKey::$TABLE_EXDENTION );
	$foetablelen = strlen ( $foreigntablename );
	$foreigntablename = substr ( $foreigntablename, 0, ($foetablelen - $exlen) );
	$formtablename = $foreigntablename . '_' . $formtablename;
	return strtolower ( $formtablename );
}
function getReferenceFieldDetailWithOutModule($con, $sformname, $formname, $fieldname, $nthinstance = '') {
	$retarray = array ();
	$string = '';
	$refformname="";
	if ($nthinstance != '') {
		$refformname = $sformname;
		$string = 'and refformname!=' . '\'' . $sformname . '\'';
	}
	//$sql = 'select refformname,reffieldname, frt.nthinstance  from formfieldreference ffr left join formrelationtable frt on ffr.relationid=frt.relationid
           // where  formname=' . '\'' . $formname . '\'' . ' and fieldname=' . '\'' . $fieldname . '\'' . $string . ';';
	//$dbrows = getResultArray ( $con, $sql );
	$dbrows=getReferenceDetailsFromSession($con,$formname,$fieldname,$refformname);
	$ressize = sizeof ( $dbrows );
	$refdetail = array ();
	if ($ressize > 0) {
		$detail = array ();
		$detail = $dbrows [0];
		$ref_formname_index = 1;
		$ref_fieldname_index = $ref_formname_index + 1;
		$ref_nth_index = $ref_fieldname_index + 1;
		$formname = $detail [$ref_formname_index];
		$fieldname = $detail [$ref_fieldname_index];
		$nthinstance = $detail [$ref_nth_index];
		
		$retarray = getReferenceFieldDetailWithOutModule ( $con, $sformname, $formname, $fieldname, $nthinstance );
		$retarray [1] = $detail;
	} else {
		$refdetail [] = $formname;
		$refdetail [] = $fieldname;
		$refdetail [] = $nthinstance;
		
		$retarray [] = $refdetail;
		$retarray [] = $dbrows;
	}
	return $retarray;
}
function getReferenceFieldDetailWithOutField($con, $formname, $rformname) {
	$retarray = array ();
	$string = 'and refformname =' . '\'' . $rformname . '\'';
	$sql = 'select refformname,reffieldname, frt.nthinstance  from formfieldreference ffr left join formrelationtable frt on ffr.relationid=frt.relationid
            where  formname=' . '\'' . $formname . '\' and fieldname not in (\'table_6_0_createdusername\',\'table_6_1_updatedusername\',\'table_6_2_viewedusername\')' . $string . ';';
	$dbrows = getResultArray ( $con, $sql );
	$ressize = sizeof ( $dbrows );
	$refdetail = array ();
	$detail = array ();
	$detail = $dbrows [0];
	$ref_formname_index = 0;
	$ref_fieldname_index = $ref_formname_index + 1;
	$ref_nth_index = $ref_fieldname_index + 1;
	$formname = $detail [$ref_formname_index];
	$fieldname = $detail [$ref_fieldname_index];
	$nthinstance = $detail [$ref_nth_index];
	$refdetail [] = $formname;
	$refdetail [] = $fieldname;
	$refdetail [] = $nthinstance;
	$retarray [] = $refdetail;
	$retarray [] = $dbrows;
	return $retarray;
}
function getReferenceFieldDetail($con, $sformname, $modulename, $formname, $fieldname, $relationdetail) {
	$conditionstr = '';
	$refformname="";
	if ($formname != $sformname) {
		$refformname=$sformname;		
		$conditionstr = 'and refformname!=' . '\'' . $sformname . '\'';
	}	
	$retarray = array ();
	//$sql = 'select refmodulename,refformname,reffieldname,
    //frt.nthinstance, frt.relation, frt.indirectform, frt.relationid,frt.iseditable,frt.multisubtablenames,ff.type from formfieldreference ffr left join formrelationtable frt on ffr.relationid=frt.relationid
    //left join formfieldtable ff on ff.formname = ffr.refformname and ffr.reffieldname = ff.name where  ffr.modulename=' . '\'' . $modulename . '\'' . ' and ffr.formname=' . '\'' . $formname . '\'' . ' and fieldname=' . '\'' . $fieldname . '\'' . $conditionstr . ';';
	//$dbrows = getResultArray ( $con, $sql );
	$dbrows=getReferenceDetailsFromSession($con,$formname,$fieldname,$refformname);
	$ressize = sizeof ( $dbrows );	
	if ($ressize > 0) {
		$detail = array ();
		$detail = $dbrows [0];
		$ref_modulename_index = 0;
		$ref_formname_index = $ref_modulename_index + 1;
		$ref_fieldname_index = $ref_formname_index + 1;
		$ref_nth_index = $ref_fieldname_index + 1;
		$ref_relation_index = $ref_nth_index + 1;
		$ref_isdirect_index = $ref_relation_index + 1;
		$ref_relationid_index = $ref_isdirect_index + 1;
		$ref_iseditable_index = $ref_relationid_index + 1;
		$ref_mul_sub_names_index = $ref_iseditable_index + 1;
		$ref_type_index = $ref_mul_sub_names_index + 1;
		$modulename = $detail [$ref_modulename_index];
		$formname = $detail [$ref_formname_index];
		$fieldname = $detail [$ref_fieldname_index];
		$nth = $detail [$ref_nth_index];
		$relation = $detail [$ref_relation_index];
		$relationid = $detail [$ref_relationid_index];
		$isdirect = $detail [$ref_isdirect_index];
		$iseditable = $detail [$ref_iseditable_index];
		$mulsubtablenames = $detail [$ref_mul_sub_names_index];
		$reffieldtype = $detail [$ref_type_index];
		
		$linkrelationdetail = array ();
		$linkrelationdetail [] = $nth;
		$linkrelationdetail [] = $relation;
		$linkrelationdetail [] = $isdirect;
		$linkrelationdetail [] = $relationid;
		$linkrelationdetail [] = $iseditable;
		$linkrelationdetail [] = $mulsubtablenames;
		$linkrelationdetail [] = $reffieldtype;
		$retarray = getReferenceFieldDetail ( $con, $sformname, $modulename, $formname, $fieldname, $linkrelationdetail );
		$retarray [1] = $detail;
	} else {
		$refdetail = array ();
		$refdetail [] = $modulename;
		$refdetail [] = $formname;
		$refdetail [] = $fieldname;
		$refdetail [] = $relationdetail [0];
		$refdetail [] = $relationdetail [1];
		$refdetail [] = $relationdetail [2];
		$refdetail [] = $relationdetail [3];
		$refdetail [] = $relationdetail [4];
		$refdetail [] = $relationdetail [5];
		$refdetail [] = $relationdetail [6];
		$retarray [] = $refdetail;
		$retarray [] = $dbrows;
	}
	return $retarray;
}
function debug($data) {
	$debug = true;
	if ($debug) {
		displaysqllogmsg ( $data );
	}
}
function setServerPath($appscon) {
	require_once ("process/MigrateSqlFunctions.php");
	migrateLogSettings ( $appscon );
	$sql = "select * from " . DBINFO::$APPDBNAME . ".serverconfig";
	$resultset = getResultArray ( $appscon, $sql );
	if (sizeof ( $resultset ) > 0) {
		$issaas = $resultset [0] [3];
		if ($issaas == '1') {
			APPINFO::$ISSAAS = true;
		} else {
			APPINFO::$ISSAAS = false;
		}
	}
}
function getAllSubTableForms($con, $modulename, $formname) {
	$sql = 'select refmodulename,refformname from formfieldreference ffr left join formfieldtable fft on ffr.formname = fft.formname  and ffr.fieldname=fft.name where  ffr.formname=' . '\'' . $formname . '\'' . ' and fft.type=' . '\'' . 'subtable' . '\'' . ';';
	return getResultArray ( $con, $sql );
}
function getAllRelatedSubTableForms($con, $modulename, $formname) {
	// $sql = 'select ffr.modulename,ffr.formname, ffr.fieldname, fft.type from formfieldreference ffr left join formfieldtable fft on ffr.formname = fft.formname and ffr.fieldname=fft.name where ffr.refformname=' . '\'' . $formname . '\'' . ' and fft.type=' . '\'' . 'subtable' . '\'' . ' and ffr.formname not in(' . '\'' . 'table_6' . '\'' . ',' . '\'' . 'table_6_group' . '\'' . ')';
	$sql = 'select ffr.modulename,ffr.formname, ffr.fieldname, fft.type from formfieldreference ffr left join formfieldtable fft on ffr.formname = fft.formname and ffr.fieldname=fft.name where ffr.refformname=' . '\'' . $formname . '\'' . '  and fft.type=' . '\'' . 'subtable' . '\'' . ' and ffr.formname not in(' . '\'' . 'table_6_group' . '\'' . ')';
	//$sql = "select modulename,formname,fieldname from formfieldreference where refformname='$formname' ;";
	return getResultArray ( $con, $sql );
}
function getGrpReferenceFieldDetail($con, $modulename, $formname, $fieldname) {
	$retGrpRef = array ();
	$refdetail_modulename_index = 0;
	$refdetail_formbname_index = $refdetail_modulename_index + 1;
	$refdetail_fieldname_index = $refdetail_formbname_index + 1;
	$relationdetail = getRelationDetailForField ( $con, $formname, $fieldname );
	$refRes = getReferenceFieldDetail ( $con, $formname, $modulename, $formname, $fieldname, $relationdetail );
	$refdetail = $refRes [0];
	$grpRef = array ();
	$grpRef [] = $refdetail [$refdetail_modulename_index];
	$grpRef [] = $refdetail [$refdetail_formbname_index] . '_group';
	$grpRef [] = 'groupname';
	$retGrpRef [] = $grpRef;
	$retGrpRef [] = $refRes [1];
	return $retGrpRef;
}
function getModulename($con, $formname) {
	$sessionkey=$formname."_modulename";
	if(!isset($GLOBALS [$sessionkey])){
	$sql = 'select modulename from formtable where formname=' . '\'' . $formname . '\'';
	$retArr = getResultArray ( $con, $sql );
	$GLOBALS [$sessionkey] = $retArr [0][0];	
	}
	return $GLOBALS [$sessionkey];	
}
function getsqlQuery($con, $formname) {
	$sql = ' select * from querytable where formname=' . '\'' . $formname . '\'';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows;
}
function insertQueryTable($con, $formname, $sqlstmt, $condstr, $leftJointablestr) {
	$sql = ' insert into querytable values(' . '\'' . $formname . '\'' . ',' . '\'' . $sqlstmt . '\'' . ',' . '\'' . $condstr . '\'' . ',' . '\'' . $leftJointablestr . '\'' . ');';
	$result = execSQL ( $con, $sql );
}
function deleteQueryDetails($con, $formname) {
	$sql = 'delete from querytable where formname=' . '\'' . $formname . '\'';
	$result = execSQL ( $con, $sql );
}
function getAllSqlStatementwithjoin($con, $modulename, $formname, $wherecond, $findactiondata, $formtablename, $joincondData, $exportdata, $refjoinstr, $ishistorysearch,$reqfromSubtable=false,$obj) {
	$sqlQryDetail = array ();
	$basicfielddetail = array ();
	$legacyformdetail = array ();
	$sqlstmt = '';
	debug("Form Name @@@@@@@@@ $formname");	
	$isReqfromSearchSuggestion=false;
	if(isset($obj->{'fieldname'}) && isset($obj->{'reqfromsearchsuggestion'})){
	$isReqfromSearchSuggestion=true;
	$sfieldname=$obj->{'fieldname'};
	$sql="select * from formfieldtable where modulename='$modulename' and formname='$formname' and name in ('$sfieldname')  order by fieldorder;";
	$basicfielddetail = getResultArray($con, $sql);
	}else{
	if ($formname == 'table_6_UserDetails') {
		$formname = 'table_6';
		$basicfielddetail = getUserFormFields ( $con, $modulename, $formname );
	} else {
		$basicfielddetail = getFormFields ( $con, $modulename, $formname );
	}	
	}	
	$superadminaccess=getSuperAdminFieldAccess($con,$formname);
	$baiscfsize = sizeof ( $basicfielddetail );
	// $sqlstatement = getsqlQuery($con, $formname);
	// if (sizeof($sqlstatement) == 0) {
	// $basicfielddetail = getFormFielddsBasicDetail($con, $modulename, $formname);
	$fieldName_index = FieldDetailIndex::$FIELD_NAME_INDEX;
	$fieldType_index = FieldDetailIndex::$FIELD_TYPE_INDEX;
	$guiField_index = FieldDetailIndex::$ISGUI_INDEX;
	$fieldorder_index = FieldDetailIndex::$FIELDORDER_INDEX;
	$fieldlable_index = FieldDetailIndex::$FIELD_LABEL_INDEX;
	$isrolling_update_index = FieldDetailIndex::$ISROLLING_UPDATE_INDEX;
	$config_hide_index = FieldDetailIndex::$ISCONFIG_HIDE_INDEX;
	$view_hide_index = FieldDetailIndex::$ISVIEW_HIDE_INDEX;
	$refEntityidMap = array ();
	$refEntityidfieldMap = array ();
	$refFieldDetailMap = array ();
	$formEntityId = $formname . '_id';
	$obj = getReqObj ();
	$appid="";
	if(isset($obj->{'APPID'})){
	$appid = $obj->{'APPID'};	
	}	
	if ($appid != '') {
		setAppId ( $appid );
	}
	$pid="";
	if(isset($obj->{'productid'})){
	$pid = $obj->{'productid'};	
	}	
	if ($pid != '') {
		setProductId ( $pid );
	}
	if ($formtablename == null) {
		$formtablename = getFormTableName ( $formname );
	}
	$isapireq = false;
	if( isset ( $obj->{"ISAPIREQ"})){
		$isapireq  = $obj->{"ISAPIREQ"};
	}
	$refdetail_modulename_index = 0;
	$refdetail_formbname_index = $refdetail_modulename_index + 1;
	$refdetail_fieldname_index = $refdetail_formbname_index + 1;
	$refdetail_nth_index = $refdetail_fieldname_index + 1;
	$hasentitygroup = false;
	$lind = 1;
	$columndetails = array ();
	$col_formname_index = 0;
	$col_fieldname_index = $col_formname_index + 1;
	$col_fieldlabel_index = $col_fieldname_index + 1;
	$col_fieldorder_index = $col_fieldlabel_index + 1;
	for($fieldindex = 0; $fieldindex < $baiscfsize; $fieldindex ++) {
		$coldetail = array ();
		$field = array ();
		$field = $basicfielddetail [$fieldindex];
		$fieldlen = sizeof ( $field );
		$fieldtype = $field [$fieldType_index];
		$fieldname = $field [$fieldName_index];
		$isguifield = $field [$guiField_index];
		$fieldorder = $field [$fieldorder_index];
		$fieldlabel = $field [$fieldlable_index];
		$isrollingupdate = $field [$isrolling_update_index];
		$confighide = $field[$config_hide_index];
		$viewhide = $field[$view_hide_index];
		if ($isguifield && $fieldtype != FieldType::$BASE_VIEW_FIELD) {
			continue;
		}
		if($exportdata == ExportType::$EXPORT_ALL_RECORD && $fieldtype != FieldType::$FORM_HISTORY){
		if(isset($superadminaccess[$fieldname]) && $superadminaccess[$fieldname] == '2'){
	    continue;
		}else if($confighide || $viewhide){
		  continue;
		}					
		}
		if ($fieldtype == FieldType::$REFERENCE || $fieldtype == FieldType::$ENTITY_GROUP || $fieldtype == FieldType::$REFERENCE_GROUP || $fieldtype == FieldType::$OWN_REFERENCE || ($fieldtype == FieldType::$FORM_HISTORY && ($fieldname == 'table_6_0_createdusername' || $fieldname == 'table_6_1_updatedusername' || $fieldname == 'table_6_2_viewedusername'))) {
			if(isset ( $obj->{'FORMTYPE'} ) && $obj->{'FORMTYPE'} == "checkin/checkout" && $isapireq){
				continue;
			}
			if ($fieldtype == FieldType::$REFERENCE && $isrollingupdate) {
				$coldetail [$col_formname_index] = $formname;
				$coldetail [$col_fieldname_index] = $fieldname;
				$coldetail [$col_fieldlabel_index] = $fieldlabel;
				$coldetail [$col_fieldorder_index] = $fieldorder;
				$columndetails [] = $coldetail;
			} else {
				$refdetail = array ();
				$relationdetail = getRelationDetailForField ( $con, $formname, $fieldname );
				$refRes = getReferenceFieldDetail ( $con, $formname, $modulename, $formname, $fieldname, $relationdetail );
				$refdetail = $refRes [0];
				$linkedforms = array ();
				$linkedref = findLinkedReference ( $refRes );
				printLinkedeferenceDetail ( $linkedref, $linkedforms );
				$refFieldDetailMap [$fieldname] = $refdetail;
				$mainrefformname = $linkedforms [0];
				$refformname = $refdetail [$refdetail_formbname_index];
				$nth = $refdetail [$refdetail_nth_index];
				$hSformname = getHStructureFormName ( $con, $refformname );
				if ($hSformname != '') {
					$refformname = $hSformname;
				}
				$reffieldname = $refdetail [$refdetail_fieldname_index];
				$refFormTableName = getFormTableName ( $refformname );
				$mainrefformtablename = getFormTableName ( $mainrefformname );
				$refformname_entityid = $refformname . '_id';
				if ($fieldtype == FieldType::$OWN_REFERENCE) {
					$refFormTableName = getFormTableName ( $refformname );
					$refformname_entityid = 'own_' . $refformname . '_id';
				}
				if ($fieldtype == FieldType::$ENTITY_GROUP) {
					$hasentitygroup = true;
					$entitygroupnth = $nth;
				}
				if (! array_key_exists ( $nth . '_' . $mainrefformtablename, $refEntityidMap )) {
					$mapcontent = array ();
					$mapcontent [] = $refformname_entityid;
					$mapcontent [] = $linkedforms;
					$refEntityidMap [$nth . '_' . $mainrefformtablename] = $mapcontent;
					if ($fieldtype != FieldType::$OWN_REFERENCE) {
						if ($fieldtype != FieldType::$REFERENCE_GROUP) {
							$coldetail [$col_formname_index] = $refformname . '_' . $nth;
							$coldetail [$col_fieldname_index] = $refformname_entityid;
							$coldetail [$col_fieldlabel_index] = $fieldlabel;
							$coldetail [$col_fieldorder_index] = $fieldorder;
							$columndetails [] = $coldetail;
							// $sqlstmt = $sqlstmt . $refformname . '_' . $nth . '.' . $refformname_entityid . ",";
						} else {
							$refEntityidfieldMap [$nth . '_' . $mainrefformtablename] = $fieldname;
							// $sqlstmt = $sqlstmt . $formname . "." . $fieldname . ",";
							$coldetail [$col_formname_index] = $formname;
							$coldetail [$col_fieldname_index] = $fieldname;
							$coldetail [$col_fieldlabel_index] = $fieldlabel;
							$coldetail [$col_fieldorder_index] = $fieldorder;
							$columndetails [] = $coldetail;
						}
					}
				} else {
					$mapcontent = $refEntityidMap [$nth . '_' . $mainrefformtablename];
					$linkedformsinmp = $mapcontent [1];
					$linkedformsinmpr = array_mergeuniquely ( $linkedformsinmp, $linkedforms );
					$mapcontent [1] = $linkedformsinmpr;
					$refEntityidMap [$nth . '_' . $mainrefformtablename] = $mapcontent;
				}
				
				$formtype = getFormType ( $con, $refformname );
				if ($formtype == FormType::$LEGACY) {
					$legacyformdetail [0] [0] = $refformname;
					$legacyformdetail [0] [1] = $refformname . '_id';
					$legacyformdetail [0] [2] = $fieldindex - 1;
					$legacyformdetail [0] [3] = $nth;
					
					$legacyformdetail [$lind] [0] = $refformname;
					$legacyformdetail [$lind] [1] = $reffieldname;
					$legacyformdetail [$lind] [2] = $fieldindex;
					$legacyformdetail [$lind] [3] = $nth;
					$lind ++;
				}
				// $sqlstmt = $sqlstmt . $refformname . '_' . $nth . '.' . $reffieldname . ",";
				$coldetail [$col_formname_index] = $refformname . '_' . $nth;
				$coldetail [$col_fieldname_index] = $reffieldname;
				$coldetail [$col_fieldlabel_index] = $fieldlabel;
				$coldetail [$col_fieldorder_index] = $fieldorder;
				$columndetails [] = $coldetail;
			}
		} else if ($fieldtype == FieldType::$SUBTABLE) {
			// do nothing now.
		} else {
			// $sqlstmt = $sqlstmt . $formname . '.' . $fieldname . ",";
			$coldetail [$col_formname_index] = $formname;
			$coldetail [$col_fieldname_index] = $fieldname;
			$coldetail [$col_fieldlabel_index] = $fieldlabel;
			$coldetail [$col_fieldorder_index] = $fieldorder;
			$columndetails [] = $coldetail;
		}
	}
	$colsize = sizeof ( $columndetails );
	$apiusercolnames = array ();
	$apitemplatecolarray = array ();
	$apiobj = getAPIObj ();
	// if ($apiobj != "") {
	// $apiusercolnames = $apiobj->getUserColumnArray();
	// $apitemplatename = $apiobj->getTempleateName();
	// $apitemplatecolarray = getTemplateFields($con, $formname, $apitemplatename, $modulename);
	// }
	$baseformname = $formname;
	for($colindex = 0; $colindex < $colsize; $colindex ++) {
		$coldetail = $columndetails [$colindex];
		$formname = $coldetail [$col_formname_index];
		$fieldname = $coldetail [$col_fieldname_index];
		$fieldlabel = $coldetail [$col_fieldlabel_index];
		$fieldorder = $coldetail [$col_fieldorder_index];
		$alise = '';		
		if ($ishistorysearch) {
			if (! startsWith ( $fieldname, 'table_' ) && ! endWith ( $fieldname, '_id' )) {
				$alise = ' as ' . '\'' . $fieldlabel . '\'';
			}
			if ( $fieldname == "table_6_id" && $isapireq && $formname == "table_6") {
				$alise = ' as ' . '\'' . $fieldlabel . '\'';
			}
			if ($fieldname != $formEntityId && startsWith ( $fieldname, 'table_' ) && endWith ( $fieldname, '_id' ) && $isapireq){
            	$alise = ' as ' . '\'' . $fieldlabel . '_id\'';
            }
			if (startsWith ( $fieldname, 'table_' ) && endWith ( $fieldname, '_6_id' ) && $isapireq){
                $alise = ' as ' . '\'' . $fieldlabel . '_id\'';
            }
			
		} else if(isset ( $obj->{"isTriggerSearch"})){
			if (! startsWith ( $fieldname, 'table_' ) && ! endWith ( $fieldname, '_id' )) {
				$formpattern = explode ( "_", $formname );
				if (sizeof ( $formpattern ) > 2) {
					if (! startsWith ( $formname, 'table_6_group' )) {
						$formnamealais = substr ( $formname, 0, - 2 );
						$alise = ' as ' . '\'' . $formname . '_' . $formnamealais . '_name\'';
					}
				} else {
					$alise = ' as ' . '\'' . $fieldname . '\'';
				}
			}
			if ( $fieldname == "table_6_id" && $isapireq && $formname == "table_6") {
				$alise = ' as ' . '\'' . $fieldlabel . '\'';
			}
			if ($fieldname != $formEntityId && startsWith ( $fieldname, 'table_' ) && endWith ( $fieldname, '_id' ) && $isapireq){
                $alise = ' as ' . '\'' . $fieldlabel . '_id\'';
            }

		}else {
			if (! startsWith ( $fieldname, 'table_' ) && ! endWith ( $fieldname, '_id' )) {
				$formpattern = explode ( "_", $formname );
				if (sizeof ( $formpattern ) > 2) {
					if (! startsWith ( $formname, 'table_6_group' )) {
						$formnamealais = substr ( $formname, 0, - 2 );
						$alise = ' as ' . '\'' . $formname . '_' . $formnamealais . '_id\'';
					}
				} else {
					$alise = ' as ' . '\'' . $fieldname . '\'';
				}
			}
			if ( $fieldname == "table_6_id" && $isapireq && $formname == "table_6") {
				$alise = ' as ' . '\'' . $fieldlabel . '\'';
			}
			if ($fieldname != $formEntityId && startsWith ( $fieldname, 'table_' ) && endWith ( $fieldname, '_id' ) && $isapireq){
                $alise = ' as ' . '\'' . $fieldlabel . '_id\'';
            }

		}		
		//if (sizeof ( $usercolnames ) > 0) {
			// if (in_array($fieldlabel, $apiusercolnames)) {
			// $sqlstmt = $sqlstmt . $formname . '.' . $fieldname . $alise . ",";
			// }
			// } else if (sizeof($apitemplatecolarray) > 0) {
			// if (in_array($fieldname, $apitemplatecolarray)) {
			// $sqlstmt = $sqlstmt . $formname . '.' . $fieldname . $alise . ",";
			// }
			// } else {
			// $sqlstmt = $sqlstmt . $formname . '.' . $fieldname . $alise . ",";
		//}
		$sqlstmt = $sqlstmt . $formname . '.' . $fieldname . $alise . ',';
	}
	$leftJointable = array ();
	$leftJointablestr = '';
	if ($formname == 'table_21') {
		$appid = $obj->{'APPID'};
		if ($appid == '') {
			$appid = getAppid ();
		}
	}
	$condstr = ' from ' . $formtablename . ' ' . $formname;
	$refMapKeys = array ();
	$refMapKeys = array_keys ( $refEntityidMap );
	$reftabsize = sizeof ( $refMapKeys );
	$nth = 0;
	$leftjoinstr = '';
	for($keyindex = 0; $keyindex < $reftabsize; $keyindex ++) {
		$reftablename = $refMapKeys [$keyindex];
		$mapcontent = $refEntityidMap [$reftablename];
		$reftableentityid = $mapcontent [0];
		$linkedforms = $mapcontent [1];
		$reftablerefgroupid="";
		if(isset($refEntityidfieldMap [$reftablename])){
		$reftablerefgroupid = $refEntityidfieldMap [$reftablename];	
		}		
		$nth = substr ( $reftablename, 0, strpos ( $reftablename, '_' ) );
		$reftablename = substr ( $reftablename, strpos ( $reftablename, '_' ) + 1 );
		$atablename = substr ( $reftablename, 0, strpos ( $reftablename, '_frm' ) );
		$tabname = $refFormTableName = getFormTableName ( $formname );
		$hSformname = getHStructureFormName ( $con, $atablename );
		if ($hSformname != '') {
			$reftablename = $hSformname . '_frm';
			$atablename = $hSformname;
		}
		if ($reftablename == $tabname) { // own reference form.
			$refformtableid = substr ( $reftableentityid, 4 ); // remove the own_ from the table id
			$leftjoinstr = $leftjoinstr . ' left join ' . $formname . '_frm ' . $formname . '_' . $nth . ' on ' . $formname . ' . ' . $formname . '_' . $nth . '_' . $reftableentityid . ' = ' . $formname . '_' . $nth . '.' . $reftableentityid;
		} else {
			if ($reftablerefgroupid != '') {
				$leftjoinstr = $leftjoinstr . ' left join ' . $reftablename . ' ' . $atablename . '_' . $nth . '  on ' . $formname . '.' . $reftablerefgroupid . '=' . $atablename . '_' . $nth . '.' . $reftableentityid . ' ';
			} else {
				$reffieldname = $atablename . '_' . $nth . '_' . $reftableentityid;
				/* **************** check the refformname using formname and refformname */
				$rformname = searchRefFormname ( $con, $formname, $reffieldname );
				if ($rformname == '') {
					$rformname = $formname;
				} else {
					$rformname = $rformname . '_' . $nth;
				}
				/* **************** End */
				$leftjoinstr = $leftjoinstr . ' left join ' . $reftablename . ' ' . $atablename . '_' . $nth . '  on ' . $rformname . '.' . $atablename . '_' . $nth . '_' . $reftableentityid . '=' . $atablename . '_' . $nth . '.' . $reftableentityid . ' ';
				$numlinkedforms = sizeof ( $linkedforms );
				for($lfi = 1; $lfi < $numlinkedforms; $lfi ++) {
					$lreftablename = getFormTableName ( $linkedforms [$lfi] );
					$latablename = substr ( $lreftablename, 0, strpos ( $lreftablename, '_frm' ) );
					$leftjoinstr = $leftjoinstr . ' left join ' . $lreftablename . ' ' . $latablename . '_' . $nth . '  on ' . $atablename . '_' . $nth . '.' . $linkedforms [$lfi] . '_' . $nth . '_' . $linkedforms [$lfi] . '_id' . '=' . $linkedforms [$lfi] . '_' . $nth . '.' . $linkedforms [$lfi] . '_id' . ' ';
				}
			}
		}
		$leftJointable [] = $reftablename;
		$leftJointablestr = $leftJointablestr . $reftablename . ',';
	}
	if ($refjoinstr!= "" && $leftjoinstr!= "" && strpos ( $leftjoinstr, $refjoinstr ) === false) {
		$leftjoinstr .= ' ' . $refjoinstr;
	}
	$condstr .= $leftjoinstr;
	$leftJointablestr = lastchartrim ( $leftJointablestr );
	$sqlstmt = lastchartrim ( $sqlstmt );
	$sqlQryDetail [] = $leftJointable;
	// insertQueryTable($con, $formname, $sqlstmt, $condstr, $leftJointablestr);
	$condstr .= $joincondData;
	// } else {
	// $sqlstmt = $sqlstatement[0][1];
	// $condstr = $sqlstatement[0][2];
	// $condstr.=$joincondData;
	// $sqlQryDetail[] = explode(",", $sqlstatement[0][3]);
	// for ($fieldindex1 = 0; $fieldindex1 < $baiscfsize; $fieldindex1++) {
	// $field = $basicfielddetail[$fieldindex1];
	// $fieldlen = sizeof($field);
	// $fieldtype = $field[$fieldType_index];
	// $fieldname = $field[$fieldName_index];
	// $refdetail = array();
	// if ($fieldtype == FieldType::$REFERENCE
	// || $fieldtype == FieldType::$ENTITY_GROUP
	// || $fieldtype == FieldType::$REFERENCE_GROUP
	// || $fieldtype == FieldType::$OWN_REFERENCE
	// || ($fieldtype == FieldType::$FORM_HISTORY && ($fieldname == 'table_6_0_createdusername' || $fieldname == 'table_6_1_updatedusername' || $fieldname == 'table_6_2_viewedusername'))) {
	//
	// $relationdetail = getRelationDetailForField($con, $formname, $fieldname);
	// $refRes = getReferenceFieldDetail($con, $formname, $modulename, $formname, $fieldname, $relationdetail);
	// $linkedforms = array();
	// $refFieldDetailMap[$fieldname] = $refdetail;
	// }
	// }
	// }
	$whereCondition = '' . $wherecond;
	// prepare find action where condition
	if ($findactiondata != null) {
		$wherealreadyExists = strlen ( $whereCondition ) < 1;
		if (! $wherealreadyExists) {
			$wherecond .= ' and ';
		}
		$bwherecond = "";
		$isalpha = $findactiondata->{'STARTC'};
		debug("Is Alpha @@@@@@@@@@@@@ $isalpha");
		if ($isalpha == 'true') {
			foreach ( $findactiondata as $findkey => $findvalue ) {
				if ($findkey == 'STARTC') {
					continue;
				}
				if ($findkey == 'advanced_search_key') {
					continue;
				}
				
				if (array_key_exists ( $findkey, $refFieldDetailMap )) {
					debug("Inside If @@@@@@@");
					$findrefField = array ();
					$findrefField = $refFieldDetailMap [$findkey];
					$findRefModuleName = $findrefField [$refdetail_modulename_index];
					$findRefFormName = $findrefField [$refdetail_formbname_index];
					$findRefFieldName = $findrefField [$refdetail_fieldname_index];
					$nthins = substr ( $findkey, 1 + strlen ( $findRefFormName ) );
					$nth1 = substr ( $nthins, strpos ( $nthins, 'table' ), - 3 );
					$nth = substr ( $nthins, 0, strpos ( $nthins, '_' ) );
					$finderfTableName = getFormTableName ( $findRefFormName );
					$atablename = substr ( $finderfTableName, 0, strpos ( $finderfTableName, '_frm' ) );
					if ($exportdata == ExportType::$EXPORT_WITHOUT_SEARCH_RECORD) {
						$bwherecond = $bwherecond . $finderfTableName . '.' . $findRefFieldName . ' not in( ' . '\'' . $findvalue . '\'' . ') or ';
					} else if ($exportdata == ExportType::$EXPORT_SELECTED_RECORD) {
						$bwherecond = $bwherecond . $findRefFormName . '.' . $formname . '_id =' . '\'' . $findvalue . '\'' . ' or ';
					} else {
						$bwherecond = $bwherecond . $atablename . '_' . $nth . '.' . $findRefFieldName . ' like \'' . $findvalue . '%' . '\'' . ' and ';
					}
				} else {
					debug("Inside Elase @@@@@@@");
					$fieldtype = getFormFieldType ( $con, $formname, $findkey );
					
					if ($exportdata == ExportType::$EXPORT_WITHOUT_SEARCH_RECORD) {
						if ($fieldtype == FieldType::$DATE) {
							$datearr = split ( " - ", $findvalue );
							$bwherecond = $bwherecond . $formtablename . '.' . $findkey . ' not between ' . '\'' . $datearr [0] . '\'' . ' and ' . '\'' . $datearr [1] . '\' or ';
						} else {
							$bwherecond = $bwherecond . $formtablename . '.' . $findkey . ' not in(' . '\'' . $findvalue . '\'' . ') or ';
						}
					} else if ($exportdata == ExportType::$EXPORT_SELECTED_RECORD) {
						$bwherecond = $bwherecond . $findRefFormName . '.' . $formname . '_id =' . '\'' . $findvalue . '\'' . ' or ';
					} else {
					   if ($fieldtype == FieldType::$DATE || $fieldtype == FieldType::$FORM_HISTORY || $fieldtype == FieldType::$DATE_TIME) {
							$datearr = split ( " - ", $findvalue );
					   if ( $fieldtype == FieldType::$FORM_HISTORY || $fieldtype == FieldType::$DATE_TIME) {
							$fromdate=$datearr [0]." 00:00:00";
							$todate=$datearr [1]." 23:59:59";
							if (IsTimeZoneSupport ()) {
		$tzoffset = getOrganizationTZOffset ( $con );
		$fromdate = getConvertedDateTimeByTZ ( $tzoffset, $fromdate, true );
		$todate = getConvertedDateTimeByTZ ( $tzoffset, $todate, true );
			}
							$bwherecond = $bwherecond . $formname . '.' . $findkey . ' between ' . '\'' . $fromdate . '\'' . ' and ' . '\'' . $todate . '\' and ';
						} else{
							$bwherecond = $bwherecond . $formname . '.' . $findkey . ' between ' . '\'' . $datearr [0] . '\'' . ' and ' . '\'' . $datearr [1] . '\' and ';
						      }
						} else {
							$bwherecond = $bwherecond . $formname . '.' . $findkey . ' like ' . '\'' . $findvalue . '%' . '\'' . ' and ';
						}
						$bwherecond = templateForBaseSearch ( $con, $bwherecond, $formname );
					}
				}
			}
		} else {
			foreach ( $findactiondata as $findkey => $findvalue ) {
				if ($findkey == 'STARTC') {
					continue;
				}
				if ($findkey == 'advanced_search_key') {
					continue;
				}
				if (array_key_exists ( $findkey, $refFieldDetailMap )) {
					$findrefField = array ();
					$findrefField = $refFieldDetailMap [$findkey];
					$findRefModuleName = $findrefField [$refdetail_modulename_index];
					$findRefFormName = $findrefField [$refdetail_formbname_index];
					$findRefFieldName = $findrefField [$refdetail_fieldname_index];
					$finderfTableName = getFormTableName ( $findRefFormName );
					if ($exportdata == ExportType::$EXPORT_WITHOUT_SEARCH_RECORD) {
						$bwherecond = $bwherecond . $formtablename . '.' . $findRefFieldName . ' not in(' . '\'' . $findvalue . '\'' . ') or ';
					} else if ($exportdata == ExportType::$EXPORT_SELECTED_RECORD) {
						$bwherecond = $bwherecond . $formname . '.' . $formname . '_id =' . '\'' . $findvalue . '\'' . ' or ';
					} else {
						$bwherecond = $bwherecond . $finderfTableName . '.' . $findRefFieldName . '=' . '\'' . $findvalue . '\'' . ' and ';
					}
				} else {
					$fieldtype = getFormFieldType ( $con, $formname, $findkey );
					if ($exportdata == ExportType::$EXPORT_WITHOUT_SEARCH_RECORD) {
						if ($fieldtype == FieldType::$DATE) {
							$datearr = split ( " - ", $findvalue );
							$bwherecond = $bwherecond . $formtablename . '.' . $findkey . ' not between ' . '\'' . $datearr [0] . '\'' . ' and ' . '\'' . $datearr [1] . '\' or ';
						} else {
							$bwherecond = $bwherecond . $formtablename . '.' . $findkey . ' not in(' . '\'' . $findvalue . '\'' . ') or ';
						}
					} else if ($exportdata == ExportType::$EXPORT_SELECTED_RECORD) {
						$bwherecond = $bwherecond . $formname . '.' . $formname . '_id =' . '\'' . $findvalue . '\'' . ' or ';
					} else {
						if ($fieldtype == FieldType::$DATE) {
							$datearr = split ( " - ", $findvalue );
							$bwherecond = $bwherecond . $formtablename . '.' . $findkey . ' between ' . '\'' . $datearr [0] . '\'' . ' and ' . '\'' . $datearr [1] . '\' and';
						} else {
							$bwherecond = $bwherecond . $formtablename . '.' . $findkey . ' like ' . '\'' . $findvalue . '%' . '\'' . ' and ';
						}
					}
				}
			}
		}
		if ($bwherecond != "") {
			$wherecond .= "(" . $bwherecond;
			$add = true;
		}
		if($bwherecond == "" && $formname == 'table_52'){
			$bwherecond = templateForBaseSearch ( $con, $bwherecond, $formname );
		}
		debug("B ehwe @@@@@@@@@ $bwherecond");
		
		$wherelen = strlen ( $wherecond );
		if ($wherelen > 0) {
			if (EndsWith ( trim ( $wherecond ), "(" )) {
				lastchartrim ( $wherecond );
				$add = false;
			}
			$wherecond = substr ( $wherecond, 0, $wherecond - 4 );
			if ($add) {
				$wherecond = $wherecond . ')';
			}
			if ($wherealreadyExists) {
				$wherecond = ' where ' . $wherecond;
			}
		}
		$whereCondition = '' . $wherecond;
	}
	$fielterrefernce = '';
	if (isset ( $obj->{'type'} )) {
		$type = $obj->{'type'};
		if ($type == 'fetchreffielter') {
			$hierarchyfield = $obj->{'hierarchyrefid'};
			$hierarchyformname = $obj->{'hierarchyrefformname'};
			$fielterrefernce = getReferenceFielterDetails ( $con, $obj, $formname, $hierarchyfield, $hierarchyformname );
		}
	}
	$securityusercondition = '';
	$securityusergroupcondition = '';
	$username = getUserId ( $con );
	
	// only for the forms having assigned to field
	$loginusername = getUserName ();
	$profile = getUserProfile ( $con, $loginusername );
	debug("Form Name @@@@@@@@@ $formname");
	if ($profile != UserDetails::$SUPER_ADMIN_PROFILE_NAME) {
		$securityusercondition = '';
		$status = false;
		$formtype = getFormType ( $con, $formname );
		if ($formtype == FormType::$REQUEST) {
			$status = isShowAlltheRequestStatus ( $con, $username, $formname );
		}
		if (! $status) {
			if($reqfromSubtable && $formname == "table_52"){
			$securityusergroupcondition=$formname.".table_6_3_table_6_id not in (0)";	
			}else{
			$securityusergroupcondition = getUserListStringBasedOnDS ( $con, $formname, $formtablename, $username, $loginusername, $entitygroupnth );	
			}			
		}
	} else {
		// only for the forms not having assigned to field
		// retrieve all entries as of now
		$securityusergroupcondition = '';
		$securityusercondition = '';
		/*
		 * $securityusercondition = " $formtablename.userid in("; $securityusercondition.="'$username'"; $securityusercondition.=')';
		 */
	}	
	if ($securityusercondition != '') {
		if ($whereCondition == '') {
			$whereCondition .= ' where ';
		} else {
			$whereCondition .= ' and ';
		}
		$whereCondition .= ' ( ' . $securityusercondition . ' ) ';
	}
	if ($fielterrefernce != '') {
		if ($whereCondition == '') {
			$whereCondition .= ' where ';
		} else {
			$whereCondition .= ' and ';
		}
		$whereCondition .= ' ( ' . $fielterrefernce . ' ) ';
	}
	if ($securityusergroupcondition != '') {
		if ($whereCondition == '') {
			$whereCondition .= ' where  ( ' . $securityusergroupcondition . ' ) ';
		} else {
			if ($securityusercondition == '') {
				$whereCondition .= ' and ( ' . $securityusergroupcondition . ' ) ';
			} else {
				$whereCondition .= ' or ' . $securityusergroupcondition;
			}
		}
	}
	if ($formname == 'table_2') {
		if ($whereCondition == '') {
			$whereCondition = $whereCondition . ' where ';
		} else {
			$whereCondition = $whereCondition . ' and ';
		}
		$whereCondition = $whereCondition . $formname . '.profile_name' . ' <> ' . '\'' . UserDetails::$SUPER_ADMIN_PROFILE_NAME . '\'';
	}
	if($formname == 'table_60' && !$reqfromSubtable){
	if ($whereCondition == '') {
			$whereCondition .= ' where ';
		} else {
			$whereCondition .= ' and ';
		}	
		$whereCondition.=" ( type <> 'Attachment') ";
	}
	if($isReqfromSearchSuggestion){
	$sqlstmt=" distinct ".$sqlstmt;	
	}		
	$sqlQryDetail [] = $whereCondition;
	$condstr = $condstr . ' ' . $whereCondition;	
	$sqlQryDetail [] = $sqlstmt;
	$sqlQryDetail [] = $condstr;
	$sqlQryDetail [] = $leftjoinstr;
	$sqlQryDetail [] = $legacyformdetail;	
	return $sqlQryDetail;
}
function searchRefFormname($con, $formname, $reffieldname) {
	$rformname = '';
	//$sql = 'select refformname from formfieldreference where formname=' . '\'' . $formname . '\'' . ' and reffieldname=' . '\'' . $reffieldname . '\'';
	//$dbrows = getResultArray ( $con, $sql );
	$dbrows=searchRefFormnameFromSession($con, $formname, $reffieldname);	
	if (sizeof ( $dbrows ) > 0) {
		$rformname = $dbrows [0] [0];
	}
	return $rformname;
}
function createRollingUpdateExternalForm($con, $formname, $fieldname) {
	$tablename = $formname . '_' . $fieldname . '_rollingupdate_frm';
	$sql = 'CREATE TABLE ' . $tablename . ' (
   `id` VARCHAR(10) ,
    `masterid` VARCHAR(10) ,
  `value` VARCHAR(100) ,
  `updateduser` VARCHAR(10) ,
  `updatedtime` TIMESTAMP
) ENGINE=InnoDB';
	execSQL ( $con, $sql );
	insertSyncQueryDetails ( $con, $tablename, "", SYNC_ACTION::$STRUC_INSERT, $sql, "" );
}
function getBuilderUserDetails($con, $appid) {
	$sql = "select createdby from " . DBINFO::$COMMONDBNAME . ".applicationlist where appid='$appid'";
	$resultArr = getResultArray ( $con, $sql );
	$createdby = $resultArr [0] [0];
	$sql = "select * from " . DBINFO::$COMMONDBNAME . ".table_6_frm where emailid='$createdby'";
	$resultArr = getResultArray ( $con, $sql );
	return $resultArr;
}
function isBuilderApp($con, $productid) {
	$isbuilderapp = false;
	$sql = "select * from " . DBINFO::$APPDBNAME . ".saasconfig where productid='$productid' and isbuilderapp='1'";
	$resultArr = getResultArray ( $con, $sql );
	if (sizeof ( $resultArr ) > 0) {
		$isbuilderapp = true;
	}
	return $isbuilderapp;
}
function getGeneralSettingPropertyValue($con, $propertyname) {
	$sql = "select propertyvalue from generalsettings where propertyname ='$propertyname'";
	$resultArr = getResultArray ( $con, $sql );
	return $resultArr [0] [0];
}
function templateForBaseSearch($con, $wherecond, $formname) {
	$obj = getReqObj ();
	$lasttempalte = $obj->{OPERATIONTYPE::$LASTTEMPLATENAME};
	if ($lasttempalte == 'Todays records') {
		$stdate = $currentdate;
		$enddate = $currentdate;
		$wherecond .= $formname . 'createdon  between \'' . $stdate . ' 00:00:00\' and \'' . $enddate . ' 23:59:59\' and ';
	} else if ($lasttempalte != '') {
		$sql = 'select searchfields from searchtemplate where templatename = ' . '\'' . $lasttempalte . '\'' . ' and formname = ' . '\'' . $formname . '\'' . ' ;';
		$resultArr = getResultArray ( $con, $sql );
		$lastsearchfield = $resultArr [0] [0];
		if ($lastsearchfield != '@') {
			$keyvaluepair = explode ( '#', $lastsearchfield );
			$keyCount = sizeof ( $keyvaluepair );
			$keyCount = $keyCount - 1;
			for($keyindex = 0; $keyindex < $keyCount; $keyindex ++) {
				$formFields = explode ( '@', $keyvaluepair [$keyindex] );
				$formFieldCount = sizeof ( $formFields );
				if ($formFieldCount == 6) {
					$type = $formFields [0];
					$tablename = $formFields [1];
					$columnname = $formFields [2];
					$operatortype = $formFields [3];
					$fieldVal = $formFields [4];
					$condop = $formFields [5];
				}
				if ($wherecond != '') {
					$wherecond = getconditionstring ( $wherecond, $type, $operatortype, $tablename, $columnname, $fieldVal, 'and' );
				}
			}
		}
	}
	return $wherecond;
}
function getconditionstring($wherecond, $type, $operatortype, $tablename, $columnname, $fieldVal, $logicaloperator) {
	if ($tablename != '') {
		$tablename = $tablename . '.';
	}
	if ($type == 'nondate') {
		if ($operatortype == 'is') {
			$wherecond .= '  (' . $tablename . $columnname . ' = ' . '\'' . $fieldVal . '\'' . ') ' . $logicaloperator;
		} else if ($operatortype == 'is not') {
			$wherecond .= '  (' . $tablename . $columnname . ' <>' . '\'' . $fieldVal . '\'' . ') ' . $logicaloperator;
		} else if ($operatortype == 'begins with') {
			$wherecond .= '  (' . $tablename . $columnname . ' like ' . '\'' . $fieldVal . '%' . '\'' . ')' . $logicaloperator;
		} else if ($operatortype == 'ends with') {
			$wherecond .= '  (' . $tablename . $columnname . ' like ' . '\'' . '%' . $fieldVal . '\'' . ')' . $logicaloperator;
		} else if ($operatortype == 'contains') {
			$wherecond .= '  (' . $tablename . $columnname . ' like ' . '\'' . '%' . $fieldVal . '%' . '\'' . ') ' . $logicaloperator;
		} else if ($operatortype == 'not contains') {
			$wherecond .= '  (' . $tablename . $columnname . ' not like ' . '\'' . '%' . $fieldVal . '%' . '\'' . ')' . $logicaloperator;
		} else if ($operatortype == 'in') {
			$wherecond .= '  (' . $tablename . $columnname . ' in (' . '\'' . $fieldVal . '\') ' . $logicaloperator;
		} else if ($operatortype == 'not in') {
			$wherecond .= '  (' . $tablename . $columnname . ' not in (' . '\'' . $fieldVal . '\') ' . $logicaloperator;
		} else if ($operatortype == 'is not empty') {
			$fieldVal = '';
			$wherecond .= '  (' . $tablename . $columnname . '  <>  ' . '\'' . $fieldVal . '\') ' . $logicaloperator;//' . ' or ' . $tablename . $columnname . ' is not null
		} else if ($operatortype == 'is empty') {
			$fieldVal = '';
			$wherecond .= '  (' . $tablename . $columnname . '  =  ' . '\'' . $fieldVal . '\'' . ' or ' . $tablename . $columnname . ' is null) ' . $logicaloperator;
		} else if ($operatortype == 'is less than') {
			$wherecond .= '  (' . $tablename . $columnname . ' < ' . '\'' . $fieldVal . '\'' . ') ' . $logicaloperator;
		} else if ($operatortype == 'is greater than') {
			$wherecond .= '  (' . $tablename . $columnname . ' > ' . '\'' . $fieldVal . '\'' . ') ' . $logicaloperator;
		} else if ($operatortype == 'is less than or equal to') {
			$wherecond .= '  (' . $tablename . $columnname . ' <= ' . '\'' . $fieldVal . '\'' . ') ' . $logicaloperator;
		} else if ($operatortype == 'is greater than or equal to') {
			$wherecond .= '  (' . $tablename . $columnname . ' >= ' . '\'' . $fieldVal . '\'' . ') ' . $logicaloperator;
		} else if ($operatortype == CHECKBOXVALUES::$DISABLED) {
			$wherecond .= '  ( ' . $tablename . $columnname . ' = ' . '\'' . CHECKBOXVALUES::$DISABLED . '\'' . ') ' . $logicaloperator;
		} else if ($operatortype == CHECKBOXVALUES::$ENABLED) {
			$wherecond .= '  ( ' . $tablename . $columnname . ' = ' . '\'' . CHECKBOXVALUES::$ENABLED . '\'' . ' ) ' . $logicaloperator; // " = 'false'";
		}
	} else if ($type == 'date') {
		if ($operatortype == 'Date is not empty') {
			$wherecond .= ' ( ' . $tablename . $columnname . ' not in(\'0000-00-00\',\'\') ' . $logicaloperator;
		} else if ($operatortype == 'Date is empty') {
			// $wherecond.=' ( ' . $tablename . $columnname . ' in(\'0000-00-00\',\'\') ' . ' ) ' . $logicaloperator;
		} else {
			$dates1 = explode ( '|', $fieldVal );
			$stdate = $dates1 [0];
			$enddate = $dates1 [1];
			$wherecond .= '  ( ' . $tablename . $columnname . '  between \'' . $stdate . ' 00:00:00\' and \'' . $enddate . ' 23:59:59\') ' . $logicaloperator;
		}
	}
	
	return $wherecond;
}
function getHStructureFormName($con, $formname) {
	$hSFormname="";
	// if (isset ( $GLOBALS [$formname . "_structentity"] )) {
		// $hSFormname = $GLOBALS [$formname . "_structentity"];
	// } else {
		// $sql = 'select structureentity FROM formtable where formname=' . '\'' . $formname . '\'';
		// $resust = getResultArray ( $con, $sql );
		// $hSFormname = $resust [0] [0];
		// $GLOBALS [$formname . "_structentity"] = $hSFormname;
	// }
	return $hSFormname;
}
function getReferenceFielterDetails($con, $obj, $formname, $hfieldname, $hformname) {
	$sql = ' select * from fetchallfilterreference where fieldname=' . '\'' . $hfieldname . '\' and formname = ' . '\'' . $hformname . '\'';
	$dbrows = getResultArray ( $con, $sql );
	$fielterstr = '';
	$fieldname = $dbrows [0] [1];
	$refformname = $dbrows [0] [2];
	$tohierarchy = $dbrows [0] [3];
	$hitypes = $dbrows [0] [4];
	$hitypes = explode ( ',', $hitypes );
	for($i = 0; $i < sizeof ( $hitypes ); $i ++) {
		$hitype = $hitypes [$i];
		$username = getUserName ();
		$formdet = getRefDetailFromFormDetail ( $con, $formname, $fieldname );
		$refdet = getformDetailFromRefDetail ( $con, $refformname, $formname );
		if ($hitype == HI_FILTER::$IMD_SUPERIERS && $tohierarchy == '0') {
			$conditionstr = getImmediateSuperiers ( $con, $formname, $fieldname, $refformname, $tohierarchy, $hitype, $username, $formdet, $refdet );
			$fielterstr = $fielterstr . $conditionstr . ' or ';
		} else if ($hitype == HI_FILTER::$PEERS && $tohierarchy == '0') {
			$conditionstr = getPeersUsers ( $con, $formname, $fieldname, $refformname, $tohierarchy, $hitype, $username, $formdet, $refdet );
			$fielterstr = $fielterstr . $conditionstr . ' or ';
		} else if ($hitype == HI_FILTER::$ALL_SUPERIERS && $tohierarchy == '0') {
			$conditionstr = getAllSuperiers ( $con, $formname, $fieldname, $refformname, $tohierarchy, $hitype, $username, $formdet, $refdet );
			$fielterstr = $fielterstr . $conditionstr . ' or ';
		} else if ($hitype == HI_FILTER::$IMD_SUBBORDINATES && $tohierarchy == '0') {
			$conditionstr = getImmediateSubbordianates ( $con, $formname, $fieldname, $refformname, $tohierarchy, $hitype, $username, $formdet, $refdet );
			$fielterstr = $fielterstr . $conditionstr . ' or ';
		} else if ($hitype == HI_FILTER::$ALL_SUBBORDINATES && $tohierarchy == '0') {
			$conditionstr = getAllSubbordianates ( $con, $formname, $fieldname, $refformname, $tohierarchy, $hitype, $username, $formdet, $refdet );
			$fielterstr = $fielterstr . $conditionstr . ' or ';
		}
	}
	$fielterstr = substr ( $fielterstr, 0, - 3 );
	return $fielterstr;
}
function getImmediateSuperiers($con, $formname, $fieldname, $refformname, $tohierarchy, $hitype, $username, $formdet, $refdet) {
	$conditionstr = '';
	$nformname = $formdet [0];
	$nfieldname = $formdet [1];
	$rformname = $refdet [0];
	$rfieldname = $refdet [1];
	if ($rformname == $formname) {
		if ($nformname != '') {
			$nformtablename = $nformname . '_frm';
			$sql = 'select ' . $rfieldname . ' from ' . $nformtablename . ' where ' . $nfieldname . ' = ' . '\'' . $username . '\'';
			$dbrows = getResultArray ( $con, $sql );
			$referenceid = $dbrows [0] [0];
			$imdsup = getImmdiateSuperiesList ( $con, $refformname, $referenceid );
			$conditionstr = $formname . '.' . $rfieldname . ' in(' . '\'' . $imdsup [0] . '\'' . ')';
		}
	}
	return $conditionstr;
}
function getImmediateSubbordianates($con, $formname, $fieldname, $refformname, $tohierarchy, $hitype, $username, $formdet, $refdet) {
	$conditionstr = '';
	$nformname = $formdet [0];
	$nfieldname = $formdet [1];
	$rformname = $refdet [0];
	$rfieldname = $refdet [1];
	if ($rformname == $formname) {
		if ($nformname != '') {
			$nformtablename = $nformname . '_frm';
			$sql = 'select ' . $rfieldname . ' from ' . $nformtablename . ' where ' . $nfieldname . ' = ' . '\'' . $username . '\'';
			$dbrows = getResultArray ( $con, $sql );
			$referenceid = $dbrows [0] [0];
			$imdsup = getgetImmediateSubbordianateList ( $con, $refformname, $referenceid );
			$conditionstr = $formname . '.' . $rfieldname . ' in(' . '\'' . $imdsup [0] . '\'' . ')';
		}
	}
	return $conditionstr;
}
function getgetImmediateSubbordianateList($con, $refformname, $referenceid) {
	$pid = $refformname . '_pid';
	$tableid = $refformname . '_id';
	$refformtable = $refformname . '_frm';
	$sql = ' select ' . $tableid . ' from ' . $refformtable . ' where ' . $pid . ' =' . '\'' . $referenceid . '\'';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows [0];
}
function getAllSuperiers($con, $formname, $fieldname, $refformname, $tohierarchy, $hitype, $username, $formdet, $refdet) {
	$conditionstr = '';
	$nformname = $formdet [0];
	$nfieldname = $formdet [1];
	$rformname = $refdet [0];
	$rfieldname = $refdet [1];
	if ($rformname == $formname) {
		if ($nformname != '') {
			$nformtablename = $nformname . '_frm';
			$sql = 'select ' . $rfieldname . ' from ' . $nformtablename . ' where ' . $nfieldname . ' = ' . '\'' . $username . '\'';
			$dbrows = getResultArray ( $con, $sql );
			$referenceid = $dbrows [0] [0];
			$slist = '';
			$allsuplist = getAllSuperiesList ( $con, $refformname, $referenceid, $slist );
			if ($allsuplist == '') {
				$allsuplist = '\'' . '' . '\'';
			}
			$conditionstr = $formname . '.' . $rfieldname . ' in(' . $allsuplist . ')';
		}
	}
	return $conditionstr;
}
function getAllSubbordianates($con, $formname, $fieldname, $refformname, $tohierarchy, $hitype, $username, $formdet, $refdet) {
	$conditionstr = '';
	$nformname = $formdet [0];
	$nfieldname = $formdet [1];
	$rformname = $refdet [0];
	$rfieldname = $refdet [1];
	if ($rformname == $formname) {
		if ($nformname != '') {
			$nformtablename = $nformname . '_frm';
			$sql = 'select ' . $rfieldname . ' from ' . $nformtablename . ' where ' . $nfieldname . ' = ' . '\'' . $username . '\'';
			$dbrows = getResultArray ( $con, $sql );
			$referenceid = $dbrows [0] [0];
			$slist = '';
			$allsuplist = getAllSubbordianatesList ( $con, $refformname, $referenceid, $slist );
			$allsuplistarr = explode ( ',', $allsuplist );
			$sublistarr = array ();
			$sublist = '';
			for($i = 0; $i < sizeof ( $allsuplistarr ); $i ++) {
				$status = in_array ( $allsuplistarr [$i], $sublistarr );
				if (! $status) {
					$sublistarr [] = $allsuplistarr [$i];
					$sublist = $sublist . $allsuplistarr [$i] . ',';
				}
			}
			$sublist = $slist = lastchartrim ( $sublist );
			if ($sublist == '') {
				$sublist = '\'' . '' . '\'';
			}
			$conditionstr = $formname . '.' . $rfieldname . ' in(' . $sublist . ')';
		}
	}
	return $conditionstr;
}
function getSubbordianatesIds($con, $refformname, $referenceid) {
	$pid = $refformname . '_pid';
	$tableid = $refformname . '_id';
	$refformtable = $refformname . '_frm';
	$sql = ' select ' . $tableid . ' from ' . $refformtable . ' where ' . $pid . ' =' . '\'' . $referenceid . '\'';
	$dbrows = getResultArray ( $con, $sql );
	$length = count ( $dbrows );
	$supid = array ();
	for($i = 0; $i < $length; $i ++) {
		$supid [] = $dbrows [$i] [0];
	}
	return $supid;
}
function getAllSubbordianatesList($con, $refformname, $referenceid, $slist) {
	$userlist = getSubbordianatesIds ( $con, $refformname, $referenceid );
	$length = count ( $userlist );
	for($i = 0; $i < $length; $i ++) {
		if ($length > 0) {
			$slist = $slist . '\'' . $userlist [$i] . '\'' . ',';
			$sublist = getAllSubbordianatesList ( $con, $refformname, $userlist [$i], $slist );
			$slist = $slist . $sublist . ',';
		}
	}
	$slist = lastchartrim ( $slist );
	return $slist;
}
function getSupervisersIds($con, $refformname, $referenceid) {
	$pid = $refformname . '_pid';
	$tableid = $refformname . '_id';
	$refformtable = $refformname . '_frm';
	$sql = ' select ' . $pid . ' from ' . $refformtable . ' where ' . $tableid . ' = ' . '\'' . $referenceid . '\'';
	$dbrows = getResultArray ( $con, $sql );
	$supid = $dbrows [0] [0];
	return $supid;
}
function getAllSuperiesList($con, $refformname, $referenceid, $slist) {
	$userlist = getSupervisersIds ( $con, $refformname, $referenceid );
	$slist = $slist . '\'' . $userlist . '\'' . ',';
	if ($userlist != 0) {
		$sublist = getAllSuperiesList ( $con, $refformname, $userlist, $slist );
		$slist = $slist . $sublist . ',';
	}
	$slist = lastchartrim ( $slist );
	return $slist;
}
function getPeersUsers($con, $formname, $fieldname, $refformname, $tohierarchy, $hitype, $username, $formdet, $refdet) {
	$conditionstr = '';
	$nformname = $formdet [0];
	$nfieldname = $formdet [1];
	$rformname = $refdet [0];
	$rfieldname = $refdet [1];
	if ($rformname == $formname) {
		if ($nformname != '') {
			$nformtablename = $nformname . '_frm';
			$sql = 'select ' . $rfieldname . ' from ' . $nformtablename . ' where ' . $nfieldname . ' = ' . '\'' . $username . '\'';
			$dbrows = getResultArray ( $con, $sql );
			$referenceid = $dbrows [0] [0];
			$imdsup = getPeersList ( $con, $refformname, $referenceid );
			$conditionstr = $formname . '.' . $rfieldname . ' in(' . '\'' . $imdsup [0] . '\'' . ')';
		}
	}
	return $conditionstr;
}
function getImmdiateSuperiesList($con, $refformname, $referenceid) {
	$pid = $refformname . '_pid';
	$tableid = $refformname . '_id';
	$refformtable = $refformname . '_frm';
	$sql = ' select ' . $pid . ' from ' . $refformtable . ' where ' . $tableid . ' = ' . '\'' . $referenceid . '\'';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows [0];
}
function getPeersList($con, $refformname, $referenceid) {
	$pid = $refformname . '_pid';
	$tableid = $refformname . '_id';
	$refformtable = $refformname . '_frm';
	$sql = ' select ' . $tableid . ' from ' . $refformtable . ' where ' . $tableid . ' = ' . '\'' . $referenceid . '\'';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows [0];
}
function getRefDetailFromFormDetail($con, $formname, $fieldname) {
	$sql = 'select refformname,reffieldname from formfieldreference where formname=' . '\'' . $formname . '\'' . ' and fieldname=' . '\'' . $fieldname . '\'';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows [0];
}
function getformDetailFromRefDetail($con, $refformname, $formname) {
	$sql = 'select formname,fieldname from formfieldreference where refformname=' . '\'' . $refformname . '\' and formname = ' . '\'' . $formname . '\'';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows [0];
}
function removeLink($con, $obj) {
	$bformname = $obj->{'baseformname'};
	$bformid = $obj->{'baseid'};
	$sformname = $obj->{'subformname'};
	$sformid = $obj->{'subid'};
	$sql = 'delete from ' . $bformname . '_' . $sformname . '_frm where ' . $sformname . '_id=' . '\'' . $sformid . '\'' . ' and ' . $bformname . '_id=' . '\'' . $bformid . '\'';
	execSQL ( $con, $sql );
}
function getUserProfile($con, $username) {	
	$profileidname = UserFieldNames::$PROFILE_ID_NAME;
	if (isset ( $GLOBALS [$profileidname . "_" . $username . "_userprofile"] )) {
		$profilename = $GLOBALS [$profileidname . "_" . $username . "_userprofile"];
	} else {
		$sql = 'select t2.profile_name from table_2_frm t2 inner join table_6_frm t6 on
            t2.table_2_id=t6.' . $profileidname . ' where t6.name=' . '\'' . $username . '\'';
		$profile_arr = getResultArray ( $con, $sql );
		$row = $profile_arr [0];
		$profilename = $row [0];
		$GLOBALS [$profileidname . "_" . $username . "_userprofile"] = $profilename;
	}
	return $profilename;
}
function updateViewedonTime($con, $obj) {
	$formname = $obj->{OPERATIONTYPE::$FORMNAME};
	$currenttime = date ( 'Y-m-d H:i:s' );
	$userid = getUserId ( $con );
	$table_id = $obj->{'tableid'};
	$formtablename = $formname . '_frm';
	$viewerid = 'table_6_2_table_6_id';
	$conditionstr = ' where ' . $formname . '_id = ' . '\'' . $table_id . '\'';
	$sql = 'select viewedon from ' . $formtablename . $conditionstr;
	$resrows = getResultArray ( $con, $sql );
	$lastviewtime = $resrows [0] [0];
	$sql = ' update ' . $formtablename . ' set ' . $viewerid . ' = ' . '\'' . $userid . '\'' . ',viewedon=' . '\'' . $currenttime . '\'' . $conditionstr;
	$result = execSQL ( $con, $sql );
	$response = array ();
	$tzoffset = getOrganizationTZOffset ( $con );
	if (IsTimeZoneSupport ()) {
		$lastviewtime = getConvertedDateTimeByTZ ( $tzoffset, $lastviewtime, false );
	}
	$response [] = $lastviewtime;
	return $response;
}
function getavailableFormsMap($con) {
	$availableForms = array ();
	$username = getUserName ();
	$profile = getUserProfile ( $con, $username );
	$index = 1;
	$sql = 'select ft.modulename,ft.formname,ft.labelname from formtable ft
            inner join table_2_frmscreen t2fs on ft.modulename=t2fs.modulename and ft.formname = SUBSTRING_INDEX(t2fs.formname, \',\', ' . $index . ')
            where t2fs.rolename =' . '\'' . $profile . '\'';
	$formsArr = getResultArray ( $con, $sql );
	$formsCount = sizeof ( $formsArr );
	for($formindex = 0; $formindex < $formsCount; $formindex ++) {
		$formsRow = $formsArr [$formindex];
		$formname = $formsRow [1];
		$fieldSql = 'select SUBSTRING_INDEX(t2fd.fields, \',\', ' . $index . ') from table_2_frmfields t2fd where t2fd.formname=' . '\'' . $formsRow [1] . '\'' . ' and t2fd.modulename= ' . '\'' . $formsRow [0] . '\'' . ' and t2fd.rolename=' . '\'' . $profile . '\'';
		$fieldsArr = getResultArray ( $con, $fieldSql );
		$fieldsCount = sizeof ( $fieldsArr );
		$availFields = array ();
		for($fieldindex = 0; $fieldindex < $fieldsCount; $fieldindex ++) {
			$fieldRow = $fieldsArr [$fieldindex];
			$fieldname = $fieldRow [0];
			$fields = explode ( ' ', $fieldname );
			$fieldtokCount = sizeof ( $fields );
			$newField = '';
			if ($fieldtokCount == 0) {
				$newField = $fieldname;
			} else {
				for($tokindex = 0; $tokindex < $fieldtokCount; $tokindex ++) {
					if ($tokindex != 0) {
						$newField .= '_';
					}
					$newField .= $fields [$tokindex];
				}
			}
			$availFields [$newField] = $fieldindex;
		}
		$availableForms [$formname] = $availFields;
	}
	return $availableForms;
}
function getAllSqlStatement($con, $modulename, $formname, $wherecond, $findactiondata, $formtablename, $refjoinstr,$isreqfromsubtable=false,$obj) {
	return getAllSqlStatementwithjoin ( $con, $modulename, $formname, $wherecond, $findactiondata, $formtablename, '', null, $refjoinstr, true,$isreqfromsubtable,$obj);
}
function getSearchSqlStatement($con, $modulename, $formname, $wherecond, $findactiondata, $formtablename, $expwithoutsearchrec, $ishistorysearch,$isreqfromsubtable=false,$obj) {
	return getAllSqlStatementwithjoin ( $con, $modulename, $formname, $wherecond, $findactiondata, $formtablename, '', $expwithoutsearchrec, '', $ishistorysearch,$isreqfromsubtable,$obj);
}
function getUserAndRoleDetail($con, $username) {
	$roleidname = UserFieldNames::$ROLE_ID_NAME;
	if (isset ( $GLOBALS [$roleidname . "_" . $username . "_userrole"] )) {
		$dbrows = $GLOBALS [$roleidname . "_" . $username . "_userrole"];
	} else {
		//$username=mysql_escape_string($username);
		$sql = 'select table_6_id, ' . $roleidname . ' from table_6_frm where name=' . '\'' . $username . '\'' . ';';
		$dbrows = getResultArray ( $con, $sql );
		$GLOBALS [$roleidname . "_" . $username . "_userrole"] = $dbrows;
	}
	return $dbrows [0];
}
function getUserId($con) {
	$username = getUserName ();
	$userdetail = getUserAndRoleDetail ( $con, $username );
	return $userdetail [0];
}
function getCurrentUserIsAdminStatus($con) {
	$curuserid = getUserId ( $con );
	$sql = "select Is_Admin from table_6_frm where table_6_id = '$curuserid'";
	$result = getResultArray ( $con, $sql );
	return $result [0] [0];
}
function getUserMailId($con) {
	$username = getUserName ();
	$sql = 'select Emailid from table_6_frm where name=' . '\'' . $username . '\'' . ';';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows [0] [0];
}
function checkUserExist($con,$usertableid){
$sql = 'select * from table_6_frm where table_6_id=' . '\'' . $usertableid . '\'' . ';';
$dbrows = getResultArray ( $con, $sql );	
if(sizeof($dbrows) > 0){
return true;	
}else{
return false;	
}
}
function getUserNameFromMailId($con, $mailid) {
	if (isset ( $GLOBALS [$mailid . "_usernamefrommail"] )) {
		$dbrows = $GLOBALS [$mailid . "_usernamefrommail"];
	} else {
		$sql = 'select name from table_6_frm where Emailid=' . '\'' . $mailid . '\'' . ';';
		$dbrows = getResultArray ( $con, $sql );
		$GLOBALS [$mailid . "_usernamefrommail"] = $dbrows;
	}
	return $dbrows [0] [0];
}
function getUserNameFromUserid($con, $userid) {
	$sql = 'select name from table_6_frm where table_6_id=' . '\'' . $userid . '\'' . ';';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows [0] [0];
}
function getGroupId($con, $userid) {
	$userSql = 'select table_6_group_id from table_6_group_mapping where table_6_id = ' . '\'' . $userid . '\'';
	$retarr = getResultArray ( $con, $userSql );
	$retCount = sizeof ( $retarr );
	$groupidarr = array ();
	for($retindex = 0; $retindex < $retCount; $retindex ++) {
		$tableRow = $retarr [$retindex];
		$groupidarr [] = $tableRow [0];
	}
	return $groupidarr;
}
function reorderFieldOrder($con, $formname, $fieldorderdeleted, $offset) {
	$sql = 'update formfieldtable set fieldorder=fieldorder-' . $offset . ' where formname=' . '\'' . $formname . '\'' . ' and fieldorder > ' . $fieldorderdeleted . ';';
	// startTransaction($con);
	execSQL ( $con, $sql );
	insertSyncQueryDetails ( $con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "" );
	$sql = "select style from formtable where formname='$formname'";
	$styleset = getResultArray ( $con, $sql );
	$stylestring = $styleset [0] [0];
	if ($stylestring != "") {
		$removefo = "f_" . $fieldorderdeleted;
		$dummyfp = "f_" . - 1;
		$stylestring = str_replace ( $removefo, $dummyfp, $stylestring );
		$sql = "select fieldorder from formfieldtable where formname='$formname' and fieldorder >= $fieldorderdeleted order by fieldorder";
		$fieldorderset = getResultArray ( $con, $sql );
		for($i = 0; $i < sizeof ( $fieldorderset ); $i ++) {
			$newfo = $fieldorderset [$i] [0];
			$oldfo = $newfo + 1;
			$stylestring = str_replace ( $oldfo, $newfo, $stylestring );
		}
		$sql = "update formtable set style='$stylestring' where formname='$formname'";
		execSQL ( $con, $sql );
		insertSyncQueryDetails ( $con, "formtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "" );
	}
	
	// commitTransaction($con);
}
function reorderFieldOrderFormField($con, $formname, $fieldname, $incroffset) {
	$sql = 'update formfieldtable set fieldorder = fieldorder+' . $incroffset . ' where formname=' . '\'' . $formname . '\'' . ' and name=' . '\'' . $fieldname . '\'' . ';';
	// startTransaction($con);
	execSQL ( $con, $sql );
	insertSyncQueryDetails ( $con, "formfieldtable", "", SYNC_ACTION::$STRUC_UPDATE, $sql, "" );
	// commitTransaction($con);
}
function getFormFielddsBasicDetail($con, $modulename, $formname) {
	$sql = 'select * from formfieldtable where modulename=' . '\'' . $modulename . '\'' . ' and formname=' . '\'' . $formname . '\'' . ' order by fieldorder;';
	return getResultArray ( $con, $sql );
}
function getFieldLabelName($con, $fname, $ffname) {
	//$sql = 'select label from formfieldtable where formname=' . '\'' . $fname . '\'' . ' and name=' . '\'' . $ffname . '\'' . ';';
	//$result = getResultArray ( $con, $sql );
	$result=getFieldLabelNameFromSession($con, $fname, $ffname);
	$labelname = '';
	if (sizeof ( $result ) > 0)
		$labelname = $result [0] [0];
	else {
		$labelname = $ffname;
	}
	return $labelname;
}
function getFieldNameByLabel($con, $fname, $label) {
	$sql = 'select name from formfieldtable where formname=' . '\'' . $fname . '\'' . ' and label=' . '\'' . $label . '\'' . ';';
	$result = getResultArray ( $con, $sql );
	$fieldname = '';
	if (sizeof ( $result ) > 0)
		$fieldname = $result [0] [0];
	else {
		$fieldname = $label;
	}
	return $fieldname;
}
function getFieldDashLabelName($con, $fname, $ffname) {
	$sql = 'select label,type from formfieldtable where formname=' . '\'' . $fname . '\'' . ' and name=' . '\'' . $ffname . '\'' . ';';
	$result = getResultArray ( $con, $sql );
	$labelname = array ();
	if (sizeof ( $result ) > 0) {
		$labelname [] = $result [0] [0];
		$labelname [] = $result [0] [1];
	} else {
		$labelname [] = $ffname;
	}
	return $labelname;
}
function getFormNames($con, $modulename) {
	$sql = 'select formname,labelname from formtable where modulename=' . '\'' . $modulename . '\'' . ';';
	$resultset = getResultSet ( $con, $sql );
	$formnames = array ();
	if ($resultset) {
		foreach ( $resultset as $row ) {
			$form_name_index = 0;
			$form_label_index = $form_name_index + 1;
			$formdetail = array ();
			$formdetail [] = $row [$form_name_index];
			$formdetail [] = $row [$form_label_index];
			$formnames [] = $formdetail;
		}
	}
	return $formnames;
}
function isPartOfForm($con, $formname, $fieldname) {
	$sql = 'select formname, type, defaultvalue,isunique from formfieldtable where formname=' . '\'' . $formname . '\'' . ' and name=' . '\'' . $fieldname . '\'' . ';';
	$data = getResultArray ( $con, $sql );
	$fnameandfieldtype = null;
	if (sizeof ( $data ) > 0) {
		$fnameandfieldtype = $data [0];
	}
	return $fnameandfieldtype;
}
function getReferenceFormname($con, $formname, $fieldname) {
	$sql = 'select fft.type , refformname from formfieldreference ffr left join formfieldtable fft on ffr.formname=fft.formname and ffr.fieldname=fft.name where ffr.formname=' . '\'' . $formname . '\'' . ' and ffr.fieldname=' . '\'' . $fieldname . '\'' . ';';
	$data = getResultArray ( $con, $sql );
	return $data;
}
function getRefFormNames($con, $modulename, $formname) {
	$sql = 'select formname from formfieldreference where refmodulename=' . '\'' . $modulename . '\'' . ' and refformname=' . '\'' . $formname . '\'' . ';';
	$data = getResultArray ( $con, $sql );
	return $data;
}
function getTableColumnDetail($con, $tablename) {
	$sql = 'desc ' . $tablename;
	return getResultArray ( $con, $sql );
}
function generateIdValue($con, $formname, $fieldvalue, $fieldkey) {
	$fieldpos = strpos ( $fieldvalue, '-R' );
	if ($fieldpos != '') {
		$fieldvalue = substr ( $fieldvalue, 0, strpos ( $fieldvalue, '-R' ) );
	}
	$sql = 'SELECT ' . $fieldkey . ' FROM ' . $formname . '_frm  where ' . $fieldkey . ' like ' . '\'' . $fieldvalue . '%' . '\'' . ' order by createdon';
	$dbrows = getResultArray ( $con, $sql );
	$size = sizeof ( $dbrows );
	$maxidvalue = $dbrows [$size - 1] [0];
	$maxid = str_replace ( $fieldvalue, '', $maxidvalue );
	if ($maxid == '') {
		$maxid = '0';
	} else {
		$maxid = str_replace ( '-R', '', $maxid );
		if ($maxid == '') {
			$maxid = '0';
		}
	}
	settype ( $maxid, 'integer' );
	$maxid = $maxid + 1;
	$idvalue = $fieldvalue . '-R' . $maxid;
	return $idvalue;
}
function isRevisionNeeded($con, $formname) {
	$status = false;
	$sql = 'select isrevisionneeded from formtable where formname=' . '\'' . $formname . '\'';
	$dbrows = getResultArray ( $con, $sql );
	if ($dbrows [0] [0] == '1') {
		$status = true;
	}
	return $status;
}
function getFormSaveSQLStmt($con, $formname, $nextid, $inpfields, $fieldsDetail) {
	$fieldstr = '';
	$dbfieldstr = '';
	$fieldnamestr = '';
	$formentity_id_key = $formname . '_id';
	if ($formname == 'table_21') {
		if ($appid == '') {
			$appid = getAppid ();
		}
	}
	foreach ( $inpfields as $fieldkey => $fieldvalue ) {				
		if ($fieldkey != OPERATIONTYPE::$SUBTABLE_INPUTFIELDS && $fieldkey != OPERATIONTYPE::$SUBTABLELINK_INPUTFIELDS && $fieldkey != OPERATIONTYPE::$LINEITEM_INPUTFIELDS && $fieldkey != OPERATIONTYPE::$BASETABLE_INPUTFIELDS && !(startsWith ( $fieldkey, 'table_' ) && endWith ( $fieldkey, '_name' ))) {
			$fieldDetails = $fieldsDetail->{$fieldkey};
			$fieldType = $fieldDetails [0];		
			$defaultValue = $fieldDetails [1];
			if ($fieldType == FieldType::$IMAGE && $formname == 'table_6' && $fieldvalue == 'img1.png') {
				$fieldvalue = "";
			} else if (($fieldType == FieldType::$IMAGE || $fieldType == FieldType::$PHOTO_CAPTURE || $fieldType == FieldType::$SIGNATURE_CAPTURE) && $fieldvalue == 'empty.png') {
				$fieldvalue = "";
			}
			if ($fieldType == FieldType::$REFERENCE_ENTITYID && $formname == 'table_6' && $fieldkey == 'table_4_0_table_4_id') {
				if ($fieldvalue == "") {
					$profileid = $inpfields->{'table_2_0_table_2_id'};
					$fieldvalue = getRoleIdFromProfileIdForUpdate ( $con, $profileid );
				}
			}
			if ($fieldkey == $formentity_id_key) {
				$fieldvalue = '' . $nextid;
				$inpfields->{$fieldkey} = $fieldvalue;
			} else if ($fieldType == FieldType::$AUTO_PREFIX) {
				$defaultValue = getFieldDefaultValue($con,$formname,$fieldkey);
				$isrevisionneeded = false; // isRevisionNeeded($con, $formname);
				if ($isrevisionneeded) {
					if ($fieldvalue == $defaultValue) {
						$fieldvalue = $defaultValue . '' . $nextid;
					} else {
						$fieldvalue = generateIdValue ( $con, $formname, $fieldvalue, $fieldkey );
					}
				} else {				
					$prefixid = getAutoMaxId($con, $formname,$fieldkey);
					$fieldvalue = $defaultValue . '' . $prefixid;
				}
				$inpfields->{$fieldkey} = $fieldvalue;
			} else if ($fieldType == FieldType::$AUTO_SUFFIX) {
				$defaultValue = getFieldDefaultValue($con,$formname,$fieldkey);			
				$suffixid = getAutoMaxId($con, $formname,$fieldkey);
				$fieldvalue = $suffixid . '' . $defaultValue;
				$inpfields->{$fieldkey} = $fieldvalue;
			} else if ($fieldType == FieldType::$DATE) {
				if ($fieldvalue != '') {
					$fieldvalue = date ( 'Y-m-d', strtotime ( $fieldvalue ) );
				}
			} else if ($fieldType == FieldType::$MOBILE_NO) {
				if ($fieldvalue != '') {
				$fieldvalue = str_replace(" ", "", $fieldvalue);
				}
			} else if ($fieldType == FieldType::$DATE_TIME) {
				if ($fieldvalue != '' && IsTimeZoneSupport ()) {
					$tzoffset = getOrganizationTZOffset ( $con );
					$fieldvalue = getConvertedDateTimeByTZ ( $tzoffset, $fieldvalue, true );
				}
			} else if ($fieldType == FieldType::$TIME) {
				if ($fieldvalue != '' && IsTimeZoneSupport ()) {
					$tzoffset = getOrganizationTZOffset ( $con );
					$fieldvalue = getConvertedTimeByTZ ( $tzoffset, $fieldvalue, true );
				}
			} else if ($fieldType == FieldType::$OWN_REFERENCE) {
				$fieldkey = 'own_' . $formentity_id_key;
			} else if ($fieldType == FieldType::$IMAGE || $fieldType == FieldType::$PHOTO_CAPTURE || $fieldType == FieldType::$SIGNATURE_CAPTURE || $fieldType == FieldType::$DOCUMENT_MULTI_FIELD || $fieldType == FieldType::$DOCUMENT_FIELD) {
				if (string_begins_with ( $fieldvalue, 'C:' ) && strpos ( $fieldvalue, 'fakepath' )) {
					$fieldvalue = substr ( $fieldvalue, 12 );
				}
			} else if ($fieldType == FieldType::$FORM_HISTORY) {
				continue;
			} else if ($fieldType == FieldType::$REFERENCE_ENTITYID) {
				$refnamefield=str_replace ( "id", "name", $fieldkey );
				$refnamefieldval=$inpfields->{$refnamefield};
				if (! is_numeric ( $fieldvalue ) || (is_numeric ($fieldvalue) && $fieldvalue == $refnamefieldval)) { // && $fieldvalue == $defaultValue
					$fieldvalue = checkReferenceFieldValue ( $con, $formname, $fieldkey, $fieldvalue );
					//$inpfields->{$fieldkey} = $fieldvalue;
				}				
				if ($fieldkey == 'table_6_1_table_6_id' || $fieldkey == 'table_6_2_table_6_id')
					continue;
				if ($fieldvalue == '') {
					$fieldvalue = null;
				} else {
					$isgroupvalue = false;
					$tokens = explode ( '@', $fieldvalue );
					if ($tokens === false) {
					} else {
						if (sizeof ( $tokens ) == 2) {
							$isgroupvalue = $tokens [0] == 'group' && $tokens [1] != "";
							$fieldvalue = $tokens [1];
						}
					}
				}
				$formpos = substr ( $fieldkey, strpos ( $fieldkey, '_table' ), - 3 );
				$formpos = substr ( $formpos, 1 );
				$nthins = substr ( $fieldkey, 1 + strlen ( $formpos ) );
				$nth1 = substr ( $nthins, strpos ( $nthins, 'table' ), - 3 );
				$nth = substr ( $nthins, 0, strpos ( $nthins, '_' ) );
				$refformname = substr ( $nthins, strpos ( $nthins, 'table' ), - 3 );
				$rformtype = getFormType ( $con, $refformname );
				if ($rformtype == FormType::$HIERARCHYSTRUCTURE || $rformtype == FormType::$HIERARCHYVALUE) {
					if ($rformtype == FormType::$HIERARCHYVALUE) {
						$hSformname = getHStructureFormName ( $con, $refformname );
						$fieldkey = $hSformname . '_' . $nth . '_' . $hSformname . '_id';
					}
					
					$isadded = isaddedHTEntity ( $con, $formname, $nextid, $fieldvalue );
					if (! $isadded) {
						addHTEntityForm ( $con, $formname, $nextid, $fieldvalue, $nth );
					}
				} else {
					$hSformname = getHStructureFormName ( $con, $refformname );
					if ($hSformname != '') {
						$fieldkey = $hSformname . '_' . $nth . '_' . $hSformname . '_id';
						if ($fieldvalue != '') {
							addHTEntityForm ( $con, $refformname, $nextid, $fieldvalue, $nth );
						}
					} else {
						// $nthinstnace = findNthInstance($con, $formname, $refformname);
						// $fieldkey = $refformname . '_' . $nthinstnace . '_' . $refformname . '_id';
					}
				}
			}else if(EndsWith($fieldkey, "_OTG_Code") ){
			$fieldvalue=generateRandomString(6);
			}
             if ($formname == 'table_6' && $fieldkey == 'Is_Admin') {
					$profileid = $inpfields->{'table_2_0_table_2_id'};
					if ($profileid == "1") {
						$fieldvalue = 'Yes';
					} else {
						$fieldvalue = 'No';
					}
				}
			$fieldnamestr = $fieldnamestr . $fieldkey . ',';
			if ($fieldvalue != null) {
				if ($isgroupvalue) {
					$groupvalue = $fieldvalue;
					$fieldstr = $fieldstr . 'NULL,' . '\'' . $fieldvalue . '\'' . ',';
					$dbfieldstr = $dbfieldstr . 'NULL,' . '\'' . $fieldvalue . '\'' . ',';
				} else {
					$ofieldvalue = $fieldvalue;
					$fieldvalue = mysql_escape_string ( $fieldvalue );
					if ($fieldkey == FieldName::$ORGANIZATION_NAME && $formname == 'table_21') {
						$cmpname = $fieldvalue;
					}
					$fieldstr = $fieldstr . '\'' . $fieldvalue . '\'' . ',';
					if ($ofieldvalue == $fieldvalue) {
						$dbfieldstr = $dbfieldstr . '\'' . $fieldvalue . '\'' . ',';
					} else {
						$ofieldvalue = str_replace ( '"', '""', $ofieldvalue );
						$dbfieldstr = $dbfieldstr . '"' . $ofieldvalue . '"' . ',';
					}
				}
			} else {
				if ($isgroupvalue) {
					$isgroupvalue = false;
				} else {
					if ($fieldType == FieldType::$REFERENCE_ENTITYID || $fieldType == FieldType::$REFERENCE_GROUP) {
						$fieldstr = $fieldstr . 'NULL,';
						$dbfieldstr = $dbfieldstr . 'NULL,';
					} else {
						if ($fieldkey == FieldName::$DISPLAY_NAME && $formname == 'table_21' && $fieldvalue == '') {
							$fieldvalue = $cmpname;
							$fieldstr = $fieldstr . '\'' . $fieldvalue . '\'' . ',';
							$dbfieldstr = $dbfieldstr . '\'' . '' . '\'' . ',';
						} else {
							$fieldstr = $fieldstr . '\'' . '' . '\'' . ',';
							$dbfieldstr = $dbfieldstr . '\'' . '' . '\'' . ',';
						}
					}
				}
			}
		}
	}
	$username = getUserId ( $con );
	if(!strpos($fieldnamestr, "table_6_1_table_6_id") > 0){
	$fieldnamestr = $fieldnamestr . 'table_6_1_table_6_id,';
	$historystr = '\'' . $username . '\'' . ',';
	}	
	$fieldnamestr = $fieldnamestr . 'table_6_2_table_6_id,';
	$historystr = $historystr . '\'' . $username . '\'' . ',';
	$currenttime = date ( 'Y-m-d H:i:s' );
	$fieldnamestr = $fieldnamestr . 'createdon' . ',';
	$historystr = $historystr . '\'' . $currenttime . '\'' . ',';
	$fieldnamestr = $fieldnamestr . 'updatedon' . ',';
	$historystr = $historystr . '\'' . $currenttime . '\'' . ',';
	$fieldnamestr = $fieldnamestr . 'viewedon';
	$historystr = $historystr . '\'' . $currenttime . '\'';
	
	$fieldstr = $fieldstr . $historystr;
	$dbfieldstr = $dbfieldstr . $historystr;
	$stmtres = array ();
	$stmtres [] = $fieldnamestr;
	$stmtres [] = $fieldstr;
	$stmtres [] = $dbfieldstr;
	return $stmtres;
}
function getRoleIdFromProfileId($con, $profileid) {
	$sql = "select role.table_4_id from table_4_frm role left join table_2_frm profile on profile.Profile_Name = role.Role_Name where table_2_id='$profileid';";
	$result = getResultArray ( $con, $sql );
	$roleid = $result [0] [0];
	return $roleid;
}
function getFormType($con, $formname) {
	//$sql = 'select formtype from formtable where formname=' . '\'' . $formname . '\'';
	$result=getFormTypeFromSession($con,$formname);
	//$result = getResultArray ( $con, $sql );
	$formtype="";
	if(isset($result [0] [0])){
	$formtype = $result [0] [0];	
	}	
	return $formtype;
}
function getModuleNameAndIsSubtableAlone($con, $formname) {
	$sql = 'select modulename, issubtablealone from formtable where formname=' . '\'' . $formname . '\'';
	$result = getResultArray ( $con, $sql );
	return $result [0];
}
function getFormTypeAndImage($con, $formname) {
	$sql = 'select formtype, image from formtable where formname=' . '\'' . $formname . '\'';
	$result = getResultArray ( $con, $sql );
	$formtype = $result [0];
	return $formtype;
}
function subTableOperation($con, $obj, $currentformtablename, $currenttableid) {
	$subtablereq = array ();
	processlineitem ( $con, $obj, $currenttableid );
	$inpfields = $obj;
	if (isset ( $obj->{OPERATIONTYPE::$FORM_INPUTFIELDS} )) {
		$inpfields = $obj->{OPERATIONTYPE::$FORM_INPUTFIELDS};
	}
	$subtablereq = $inpfields->{OPERATIONTYPE::$SUBTABLE_INPUTFIELDS};
	$subtablesize = sizeof ( $subtablereq );
	for($index = 0; $index < $subtablesize; $index ++) {
		$subTabledata = $subtablereq [$index];
		$tableInfo = $subTabledata [SubTableReqFormat::$TABLE_INFO];
		$newRowInfo = $subTabledata [SubTableReqFormat::$NEW_ROWDATA_INFO];
		$updatedRowInfo = $subTabledata [SubTableReqFormat::$UPDATED_ROWDATA_INFO];
		$deleteRowInfo = $subTabledata [SubTableReqFormat::$DELETED_ROWDATA_INFO];
		subTableSaveOperation ( $con, $obj, $currenttableid, $tableInfo, $newRowInfo );
		subTableUpdateOperation ( $con, $obj, $tableInfo, $updatedRowInfo );
		subTableDeleteOperation ( $con, $obj, $tableInfo, $deleteRowInfo );
	}
	$subtablelinkreq = $inpfields->{OPERATIONTYPE::$SUBTABLELINK_INPUTFIELDS};
	$subtablelinksize = sizeof ( $subtablelinkreq );
	for($index = 0; $index < $subtablelinksize; $index ++) {
		$subtablelinkdata = $subtablelinkreq [$index];
		if (sizeof ( $subtablelinkdata ) > 0) {
			$tableInfo = $subtablelinkdata [SubTableReqFormat::$TABLE_INFO];
			$newRowInfo = $subtablelinkdata [SubTableReqFormat::$NEW_ROWDATA_INFO];
			$updatedRowInfo = $subtablelinkdata [SubTableReqFormat::$UPDATED_ROWDATA_INFO];
			$deleteRowInfo = $subtablelinkdata [SubTableReqFormat::$DELETED_ROWDATA_INFO];
			subTableLinkSaveOperation ( $con, $obj, $currenttableid, $tableInfo, $newRowInfo );
		}
	}
	$basetablereq = $inpfields->{OPERATIONTYPE::$BASETABLE_INPUTFIELDS};
	$basetablesize = sizeof ( $basetablereq );
	if ($basetablesize > 0) {
		$exlen = strlen ( BuilderKey::$TABLE_EXDENTION ) + 1;
		$length = sizeof ( $currentformtablename );
		$formname = substr ( $currentformtablename, 0, ($length - $exlen) );
		$baseforms = getBaseForms ( $con, $formname );
		$bsize = sizeof ( $baseforms );
		for($index = 0; $index < $bsize; $index ++) {
			if (getLinkType ( $con, $baseforms [$index], $formname ) == 1) {
				$nformtablename = $baseforms [$index] . '_' . $formname . '_frm';
				$dsql = 'delete from `' . $nformtablename . '` where ' . $formname . '_id=' . '\'' . $currenttableid . '\'';
				$result = execSQL ( $con, $dsql );
				if ($baseforms [$index] != "table_6") {
					insertSyncQueryDetails ( $con, $nformtablename, "", DB_ACTION::$SUB_TABLE_DELETE, $dsql );
				}
			}
		}
	}
	for($index = 0; $index < $basetablesize; $index ++) {
		$basetabledata = $basetablereq [$index];
		if (sizeof ( $basetabledata ) > 0) {
			$tableInfo = $basetabledata [SubTableReqFormat::$TABLE_INFO];
			$newRowInfo = $basetabledata [SubTableReqFormat::$NEW_ROWDATA_INFO];
			$updatedRowInfo = $basetabledata [SubTableReqFormat::$UPDATED_ROWDATA_INFO];
			$deleteRowInfo = $basetabledata [SubTableReqFormat::$DELETED_ROWDATA_INFO];
			baseTableSaveOperation ( $con, $obj, $currentformtablename, $currenttableid, $tableInfo, $newRowInfo );
		}
	}
}
function getBaseForms($con, $refformname) {
	$sql = 'select formname from formfieldreference where refformname=' . '\'' . $refformname . '\'' . ' and fieldname=' . '\'' . $refformname . '\'';
	$returnARr = getResultArray ( $con, $sql );
	$returnsize = sizeof ( $returnARr );
	$returnformnames = array ();
	for($returnindex = 0; $returnindex < $returnsize; $returnindex ++) {
		$row = $returnARr [$returnindex];
		$returnformnames [] = $row [0];
	}
	return $returnformnames;
}
function baseTableSaveOperation($con, $obj, $currentformtablename, $currenttableid, $basetableinfo, $basetabledata) {
	$bformdetail = $basetableinfo [0];
	$bmodulename = $bformdetail [0];
	$bformname = $bformdetail [1];
	$exlen = strlen ( BuilderKey::$TABLE_EXDENTION ) + 1;
	$length = sizeof ( $currentformtablename );
	$formname = substr ( $currentformtablename, 0, ($length - $exlen) );
	$bformtablename = getFormTableName ( $bformname );
	$formtablename = getSubFormTableName ( $bformtablename, $currentformtablename );
	$size = sizeof ( $basetabledata );
	$displayfieldname = getDisplayFieldName ( $con, $bformname );
	for($rowindex = 0; $rowindex < $size; $rowindex ++) {
		$rowdata = $basetabledata [$rowindex];
		$formname1 = extractformnamefromtablename ( $bformtablename );
		$formname2 = extractformnamefromtablename ( $currentformtablename );
		
		if ($rowdata == '') {
			$deleteentrysql = 'delete from `' . $formtablename . '` where  ' . $formname2 . '_id = ' . $currenttableid . ';';
			$result = execSQL ( $con, $deleteentrysql );
			if ($bformtablename != "table_6") {
				insertSyncQueryDetails ( $con, $formtablename, "", DB_ACTION::$SUB_TABLE_DELETE, $deleteentrysql );
			}
			continue;
		}
		
		$checkingentrysql = 'select  ' . $formname1 . '_id from .' . $formtablename . ' where ' . $formname1 . '_id = ' . $rowdata . ' and ' . $formname2 . '_id = ' . $currenttableid . ';';
		$cresult = getResultArray ( $con, $checkingentrysql );
		if (sizeof ( $cresult ) === 0) {
			$datastr = '';
			$datastr = '\'' . $rowdata . '\'' . ',' . '\'' . $currenttableid . '\'';
			$sql = 'insert into `' . $formtablename . '`  values(' . $datastr . ');';
			$result = execSQL ( $con, $sql );
			insertSyncQueryDetails ( $con, $formtablename, "", DB_ACTION::$SUB_TABLE_INSERT, $sql );
			$displaysql = 'select ' . $displayfieldname . ' from ' . $bformname . '_frm where ' . $bformname . '_id=' . '\'' . $rowdata . '\'';
			$retArr = getResultArray ( $con, $displaysql );
			if (sizeof ( $retArr ) > 0) {
				$row = $retArr [0];
				$refname = $row [0];
				$updatesql = 'update ' . $formname . '_frm set Related_to=' . '\'' . $refname . '\'' . ' where ' . $formname . '_id=' . '\'' . $currenttableid . '\'';
				$result = execSQL ( $con, $updatesql );
				insertSyncQueryDetails ( $con, $formname . '_frm', "", DB_ACTION::$SUB_TABLE_UPDATE, $updatesql );
			}
		}
	}
}
function getLinkType($con, $foreign_formname, $formname) {
	$sql = 'select reffieldname from formfieldreference where formname=' . '\'' . $foreign_formname . '\'' . ' and refformname=' . '\'' . $formname . '\'' . ' and fieldname=' . '\'' . $formname . '\'';
	$retArray = getResultArray ( $con, $sql );
	$retVal = 0;
	if (sizeof ( $retArray ) > 0) {
		$row = $retArray [0];
		$fieldval = $row [0];
		if ($fieldval == 'one to one link mapping') {
			$retVal = 1;
		}
	}
	return $retVal;
}
function subTableLinkSaveOperation($con, $obj, $foreignid, $tableInfo, $subTabledata) {
	$foreign_formname = $obj->{OPERATIONTYPE::$FORMNAME};
	$foreign_modulename = $obj->{OPERATIONTYPE::$MODULENAME};
	$foreign_tablename = getFormTableName ( $foreign_formname );
	
	$foreign_formname_entity_id = $foreign_formname . '_id';
	$size = sizeof ( $subTabledata );
	$formdetail = $tableInfo [0];
	$modulename = $formdetail [0];
	$formname = $formdetail [1];
	
	$formtablename = getFormTableName ( $formname );
	$formtablename = getSubFormTableName ( $foreign_tablename, $formtablename );
	$displayfieldname = getDisplayFieldName ( $con, $foreign_formname );
	for($rowindex = 0; $rowindex < $size; $rowindex ++) {
		$rowdata = $subTabledata [$rowindex];
		$datastr = '';
		$datastr = '\'' . $foreignid . '\'' . ',' . '\'' . $rowdata [0] . '\'';
		if (getLinkType ( $con, $foreign_formname, $formname ) == 1) {
			$baseforms = getBaseForms ( $con, $formname );
			$bsize = sizeof ( $baseforms );
			for($index = 0; $index < $bsize; $index ++) {
				$nformtablename = $baseforms [$index] . '_' . $formname . '_frm';
				$dsql = 'delete from `' . $nformtablename . '` where ' . $formname . '_id=' . '\'' . $rowdata [0] . '\'';
				$result = execSQL ( $con, $dsql );
				if ($baseforms [$index] != "table_6") {
					insertSyncQueryDetails ( $con, $nformtablename, "", DB_ACTION::$SUB_TABLE_DELETE, $dsql );
				}
			}
		}
		$sql = 'insert into `' . $formtablename . '`  values(' . $datastr . ');';
		insertSyncQueryDetails ( $con, $formtablename, "", DB_ACTION::$SUB_TABLE_INSERT, $sql );
		$displaysql = 'select ' . $displayfieldname . ' from ' . $foreign_formname . '_frm where ' . $foreign_formname . '_id=' . '\'' . $foreignid . '\'';
		$retArr = getResultArray ( $con, $displaysql );
		if (sizeof ( $retArr ) > 0) {
			$row = $retArr [0];
			$refname = $row [0];
			$updatesql = 'update ' . $formname . '_frm set Related_to=' . '\'' . $refname . '\'' . ' where ' . $formname . '_id=' . '\'' . $rowdata [0] . '\'';
			$result = execSQL ( $con, $updatesql );
			insertSyncQueryDetails ( $con, $formname . '_frm', "", DB_ACTION::$SUB_TABLE_UPDATE, $updatesql );
		}
		$result = execSQL ( $con, $sql );
	}
}
function subTableSaveOperation($con, $obj, $foreignid, $tableInfo, $subTabledata) {
	$foreign_formname = $obj->{OPERATIONTYPE::$FORMNAME};
	$foreign_modulename = $obj->{OPERATIONTYPE::$MODULENAME};
	$foreign_tablename = getFormTableName ( $foreign_formname );
	
	$foreign_formname_entity_id = $foreign_formname . '_id';
	$size = sizeof ( $subTabledata );
	$formdetail = $tableInfo [0];
	$columndetail = $tableInfo [1];
	$modulename = $formdetail [0];
	$formname = $formdetail [1];
	$colnamestr = $foreign_formname_entity_id . ',';
	$colsize = sizeof ( $columndetail );
	for($colindex = 0; $colindex < $colsize; $colindex ++) {
		$colnamestr = $colnamestr . $columndetail [$colindex] . ',';
	}
	$colnamestr = lastchartrim ( $colnamestr );
	$formtablename = getFormTableName ( $formname );
	$formtablename = getSubFormTableName ( $foreign_tablename, $formtablename );
	for($rowindex = 0; $rowindex < $size; $rowindex ++) {
		$rowdata = $subTabledata [$rowindex];
		$datasize = sizeof ( $rowdata );
		$datastr = '';
		$nextid = getFormMaxId ( $con, $formtablename );
		$datastr = '\'' . $foreignid . '\'' . ',' . '\'' . $nextid . '\'' . ',';
		for($dataindex = 1; $dataindex < $datasize; $dataindex ++) {
			$datastr = $datastr . '\'' . $rowdata [$dataindex] . '\'' . ',';
		}
		$datastr = lastchartrim ( $datastr );
		$sql = 'insert into `' . $formtablename . '` (' . $colnamestr . ') values(' . $datastr . ');';
		$result = execSQL ( $con, $sql );
		if ($result) {
			insertSyncQueryDetails ( $con, $formtablename, "", DB_ACTION::$SUB_TABLE_INSERT, $sql );
			updateFormMaxId ( $con, $formtablename, $nextid );
		}
	}
}
function subTableUpdateOperation($con, $obj, $tableInfo, $subTabledata) {
	$foreign_formname = $obj->{OPERATIONTYPE::$FORMNAME};
	$foreign_modulename = $obj->{OPERATIONTYPE::$MODULENAME};
	$foreign_tablename = getFormTableName ( $foreign_formname );
	$size = sizeof ( $subTabledata );
	$formdetail = $tableInfo [0];
	$columndetail = $tableInfo [1];
	$modulename = $formdetail [0];
	$formname = $formdetail [1];
	$formtablename = getFormTableName ( $formname );
	$formtablename = getSubFormTableName ( $foreign_tablename, $formtablename );
	
	$colsize = sizeof ( $columndetail );
	for($rowindex = 0; $rowindex < $size; $rowindex ++) {
		$rowdata = $subTabledata [$rowindex];
		$updateSQL = 'update `' . $formtablename . '` set ';
		for($colindex = 0; $colindex < $colsize; $colindex ++) {
			$colvalue = $rowdata [$colindex];
			$colname = $columndetail [$colindex];
			$updateSQL = $updateSQL . $colname . '=' . '\'' . $colvalue . '\'' . ',';
		}
		$entity_id_name = $columndetail [0];
		$entity_id_value = $rowdata [0];
		$updateSQL = lastchartrim ( $updateSQL );
		$whCond = ' where ' . $entity_id_name . '=' . '\'' . $entity_id_value . '\'' . ';';
		$updateSQL = $updateSQL . $whCond;
		execSQL ( $con, $updateSQL );
		insertSyncQueryDetails ( $con, $formtablename, "", DB_ACTION::$SUB_TABLE_UPDATE, $updateSQL );
	}
}
function subTableDeleteOperation($con, $obj, $tableInfo, $subTabledata) {
	$foreign_formname = $obj->{OPERATIONTYPE::$FORMNAME};
	$foreign_modulename = $obj->{OPERATIONTYPE::$MODULENAME};
	$foreign_tablename = getFormTableName ( $foreign_formname );
	$size = sizeof ( $subTabledata );
	$formdetail = $tableInfo [0];
	$columndetail = $tableInfo [1];
	$modulename = $formdetail [0];
	$formname = $formdetail [1];
	$formtablename = getFormTableName ( $formname );
	$formtablename = getSubFormTableName ( $foreign_tablename, $formtablename );
	$entity_id_name = $columndetail [0];
	for($rowindex = 0; $rowindex < $size; $rowindex ++) {
		$rowdata = $subTabledata [$rowindex];
		$entity_id_value = $rowdata [0];
		$delSQL = 'delete from `' . $formtablename . '` where ' . $entity_id_name . '=' . '\'' . $entity_id_value . '\'' . ';';
		execSQL ( $con, $delSQL );
		insertSyncQueryDetails ( $con, $formtablename, "", DB_ACTION::$SUB_TABLE_UPDATE, $delSQL );
	}
}
function getSubtableCreatedAlone($con, $modulename, $formname) {
	$subtable = FieldType::$SUBTABLE;
	$sql = 'select issubtablealone from formtable where modulename=' . '\'' . $modulename . '\'' . ' and formname=' . '\'' . $formname . '\'' . ' and formtype=' . '\'' . $subtable . '\'' . ' ;';
	$result = getResultArray ( $con, $sql );
	return $result [0] [0];
}
function getMultiSubtableCondition($con, $obj, $mulsubtablename, $refformname) {
	$formname = $obj->{OPERATIONTYPE::$FORMNAME};
	$modulename = $obj->{OPERATIONTYPE::$MODULENAME};
	$wherecond = '';
	if ($mulsubtablename != '') {
		$sql = 'select conditionstr from multisubtableinformation where subtablename=' . '\'' . $mulsubtablename . '\'' . ' and formname=' . '\'' . $formname . '\'' . ' and refformname =' . '\'' . $refformname . '\'';
		$getalldata = getResultArray ( $con, $sql );
		if (sizeof ( $getalldata ) > 0) {
			$condtion = $getalldata [0] [0];
			$wherecond = constructWhereCondition ( $con, $modulename, $formname, $condtion, '', '', '', '' );
		}
	} else {
		$sql = 'select conditionstr from multisubtableinformation where formname=' . '\'' . $formname . '\'' . ' and refformname =' . '\'' . $refformname . '\'';
		$getalldata = getResultArray ( $con, $sql );
		$size = sizeof ( $getalldata );
		for($i = 0; $i < $size; $i ++) {
			$condtion = $getalldata [$i] [0];
			$searchtype = ExportType::$EXPORT_WITHOUT_SEARCH_RECORD;
			$wherecond = constructWhereCondition ( $con, $modulename, $formname, $condtion, '', '', $searchtype, '' );
			if ($i > $size - 1) {
				$wherecond = $wherecond . ' and ';
			}
		}
	}
	return $wherecond;
}
function getFieldHistory($con, $fieldname, $tablename) {
	$fieldtype = getFormFieldType ( $con, $formname, $fieldname );
	$sql = 'select r.id,' . $fieldname . ',r.value,u.Name,r.updatedtime from ' . $tablename . ' r, table_6_frm u where r.updateduser = u.table_6_id order by r.updatedtime';
	if ($fieldtype == FieldType::$REFERENCE || $fieldtype == FieldType::$ENTITY_GROUP) {
		$rowrefdetail = getReferenceFieldDetailWithOutModule ( $con, $formname, $formname, $fieldname );
		$refformname = $rowrefdetail [0] [0];
		$reffieldname = $rowrefdetail [0] [1];
		$sql = 'select r.id,' . $fieldname . ',ref.' . $reffieldname . ',u.Name,r.updatedtime from ' . $tablename . ' r, table_6_frm u ,' . $refformname . '_frm ref where r.updateduser = u.table_6_id and ref.' . $refformname . '_id = r.value order by r.updatedtime';
	}
	$resultrows = getResultArray ( $con, $sql );
	return $resultrows;
}
function getAllSubTableData($con, $obj) {
	$response = array ();
	$foreign_formname = $obj->{OPERATIONTYPE::$FORMNAME};
	$foreign_modulename = $obj->{OPERATIONTYPE::$MODULENAME};
	$foreign_tablename = getFormTableName ( $foreign_formname );
	$subtablereq = $obj->{OPERATIONTYPE::$SUBTABLE_INPUTFIELDS};
	$pagenumber = $obj->{OPERATIONTYPE::$PAGENUMBER};
	$noofrow = $obj->{OPERATIONTYPE::$NUMBEROFROW};
	$username = getUserName ();
	$reqsize = sizeof ( $subtablereq );
	$modulename_index = 0;
	$isapireq = false;
	if (isset ( $obj->{"ISAPIREQ"} )) {
	$isapireq = $obj->{"ISAPIREQ"};
	}
	debug("TEsting :");
	$formname_index = $modulename_index + 1;
	$parent_field_name_index = $formname_index + 1;
	$parent_field_id_index = $parent_field_name_index + 1;
	$multi_sub_index = $parent_field_id_index + 1;
	for($reqindex = 0; $reqindex < $reqsize; $reqindex ++) {
		$reqRow = $subtablereq [$reqindex];
		$modulename = $reqRow [$modulename_index];
		$formname = $reqRow [$formname_index];
		// if ($modulename == 'History') {
		// $rollingupdatefields = rollingUpdateFields($con, $foreign_formname);
		// $rollresultrows = array();
		// for ($ri = 0; $ri < sizeof($rollingupdatefields); $ri++) {
		// $rfield = $rollingupdatefields[$ri];
		// $rollupdatetablename = $foreign_formname . '_' . $rfield . '_rollingupdate_frm';
		// $rows = getFieldHistory($con, $rfield, $rollupdatetablename);
		// for ($rowind = 0; $rowind < sizeof($rows); $rowind++) {
		// $rollresultrows[] = $rows[$rowind];
		// }
		// }
		// $retArr = getLimitArray($con, $obj, $rollresultrows, $pagenumber, $noofrow);
		// $tempdetails = getTempleteDetails($con, $foreign_formname, $formname, $username);
		// $response[] = $retArr;
		// $response[] = $tempdetails;
		// continue;
		// }
		
		$basicfielddetail = getFormFields ( $con, $modulename, $formname , $isapireq);
		$retArr = array ();
		$dbrows = array ();
		if (sizeof ( $basicfielddetail ) != 0) {
			$wherecond = '';
			$search_data = null;
			$table_name = null;
			$parent_field_name = $reqRow [$parent_field_name_index];
			$parent_field_id = $reqRow [$parent_field_id_index];
			$mulsubtablename = $reqRow [$multi_sub_index];
			$formtablename = getFormTableName ( $formname );
			$formtablename = getSubFormTableName ( $foreign_tablename, $formtablename );
			$nth = findNthInstance ( $con, $foreign_formname, $formname );
			$formtablename = $nth . $formtablename;
			$formtype = getFormType ( $con, $foreign_formname );
			$joincond = ' right join ' . $formtablename . ' ' . $formtablename . ' on  ' . $formtablename . '.' . $formname . '_id = ' . $formname . '.' . $formname . '_id ';
			$wherecond = getMultiSubtableCondition ( $con, $obj, $mulsubtablename, $formname );
			if ($parent_field_id != '') {
				$cond = 'where ';
				if ($wherecond != '') {
					$cond = ' and ';
				}
				$wherecond = $wherecond . '' . $cond . '' . $formtablename . '.' . $foreign_formname . '_id=' . "'" . $parent_field_id . "'";
			} else {
				for($reqindex1 = 0; $reqindex1 < $reqsize; $reqindex1 ++) {
					$reqRowss = $subtablereq [$reqindex1];
					$mname = $reqRowss [$modulename_index];
					$fname = $reqRowss [$formname_index];
					$tempdetails = getTempleteDetails ( $con, $foreign_formname, $fname, $username );
					$response [] = array ();
					$response [] = $tempdetails;
				}
				
				return $response;
			}
			$sqldetail = getAllSqlStatementwithjoin ( $con, $modulename, $formname, $wherecond, $search_data, $table_name, $joincond, null, '', true,true);
			$sql = 'select ' . $sqldetail [GetAllSQlFormat::$QRY_STMT_INDEX] . $sqldetail [GetAllSQlFormat::$QRY_FROM_INDEX];
			if (strpos ( $sql, 'where' ) !== false) {
				$sql .= " and " . $formname . "." . $formname . "_id != ''";
			} else {
				$sql .= " where " . $formname . "." . $formname . "_id != ''";
			}
			if ($modulename == 'Notes') {
				$sql .= ' order by ' . $formname . '.updatedon DESC';
			}
			if ($modulename == 'History') {
				$sql .= ' order by ' . $formname . '.createdon';
			}
			if ($formname == 'table_52') {
				$sql .= ' order by ' . $formname . '.createdon DESC';
			}
			$formtype = getFormType ( $con, $formname );
			// if ($formtype == FormType::$REQUEST) {
			// $reqlatestrec = getRequestLastRecordconditionStr($con, $formname);
			// $sql .= $reqlatestrec;
			// }
			$revcondstr = getRevisionConditionStr ( $con, $formname );
			if ($revcondstr != '') {
				$pos = strpos ( $sql, 'where' );
				$cond = ' and ';
				if ($pos === false) {
					$cond = ' where ';
				}
				$sql .= $cond . $revcondstr;
			}
			$loginusername = getUserName ();
			$profile = getUserProfile ( $con, $loginusername );
			if ($foreign_formname == "table_39" && $formname = 'table_6' && $profile != UserDetails::$SUPER_ADMIN_PROFILE_NAME) {
				$seccond = " 3table_39_table_6_frm.table_6_id !=  '0'";
				$pos = strpos ( $sql, 'where' );
				$cond = ' and ';
				if ($pos === false) {
					$cond = ' where ';
				}
				$sql .= $cond . $seccond;
			}
            debug("ISAPI REQ TRUE: ".$isapireq);		
			debug("SQL FOR SELECT: ".$sql);
			if(!$isapireq){
				$getalldata = getResultArray ( $con, $sql );
			} else {
				$getalldata = getResultAsscData ( $con, $sql );
			}
			$legacydetails = $sqldetail [GetAllSQlFormat::$LEGACY_DETAIL_INDEX];
			$lfieldsize = sizeof ( $legacydetails );
			if ($lfieldsize > 0) {
				$lfieldnames = '';
				$lsql = '';
				$lformname = '';
				$idfieldname = '';
				$nthinstance = 0;
				$sindex = 0;
				$tpconn = '';
				$tablename = '';
				for($i = 0; $i < $lfieldsize; $i ++) {
					
					$legformdet = $legacydetails [$i];
					$lformname = $legformdet [0];
					$fieldname = $legformdet [1];
					$nthinstance = $legformdet [3];
					$tpconndet = getThirdPartyConnection ( $con, $lformname );
					$tpconn = $tpconndet [0];
					$condetail = $tpconndet [1];
					$dbname = $condetail [5];
					$tablename = $condetail [6];
					$legfieldname = getLegacyFieldName ( $con, $lformname, $fieldname );
					if ($i == 0) {
						$sindex = $legformdet [2];
						$idfieldname = $legfieldname;
					}
					$lfieldnames = $lfieldnames . $tablename . '.' . $legfieldname . ',';
				}
				$lfieldnames = lastchartrim ( $lfieldnames );
				for($ri = 0; $ri < sizeof ( $getalldata ); $ri ++) {
					$rowdata = $getalldata [$ri];
					$fieldname = $lformname . '_' . $nthinstance . '_' . $lformname . '_id';
					$nformtablename = $formname . '_frm';
					$sql = 'SELECT ' . $fieldname . ' from ' . $nformtablename . ' where ' . $formname . '_id = ' . '\'' . $rowdata [0] . '\'';
					$getformdata = getResultArray ( $con, $sql );
					$formid = $getformdata [0] [0];
					$sql = 'SELECT ' . $lfieldnames . ' from ' . $tablename . ' where ' . $idfieldname . ' = ' . '\'' . $formid . '\'';
					$getlegdata = getResultArray ( $tpconn, $sql );
					$legrowdata = $getlegdata [0];
					for($li = 0; $li < sizeof ( $legrowdata ); $li ++) {
						$data = $legrowdata [$li];
						$getalldata [$ri] [$li + 1] = $data;
					}
				}
			}
			$retArr = getLimitArray ( $con, $obj, $getalldata, $pagenumber, $noofrow,$formname);
			$tempdetails = getTempleteDetails ( $con, $foreign_formname, $formname, $username );
		} else {
			$tempdetails = array ();
		}
		$response [] = $retArr;
		$response [] = $tempdetails;
	}
	return $response;
}
function getTempleteDetails($con, $formname, $sformname, $username) {
	$sql = ' select * from subtable_searchtemplate where formname=' . '\'' . $formname . '\'' . ' and sformname=' . '\'' . $sformname . '\'' . ' and username =' . '\'' . 'sadmin' . '\'';
	$getalldata = getResultArray ( $con, $sql );
	if (sizeof ( $getalldata ) == 0) {
		$modulename = getModulename ( $con, $sformname );
		if ($modulename == 'Notes') {
			$sql = ' select * from subtable_searchtemplate where formname=' . '\'' . $formname . '\'' . ' and sformname=' . '\'' . $sformname . '\'' . ' and username =' . '\'' . '' . '\'';
			$getalldata = getResultArray ( $con, $sql );
		}
	}
	return $getalldata;
}
function isSubTableNotAlone($con, $subtablename) {
	$sql = 'select issubtablealone from formtable where formname=' . '\'' . $subtablename . '\'' . ';';
	$result = getResultArray ( $con, $sql );
	if ($result [0] [0] == '0') {
		return true;
	} else
		return false;
}
function deleteSubTableDatas($con, $obj, $formid) {
	$formname = $obj->{OPERATIONTYPE::$FORMNAME};
	$relationdetails = findSubtableRelationDetail ( $con, $formname );
	$numdetails = sizeof ( $relationdetails );
	$sql = "select refformname from formfieldreference ffref where formname = '$formname' and refmodulename = 'Attachments'";
	$sresult = getResultArray ( $con, $sql );
	if (sizeof ( $sresult ) > 0) {
		$tablename = '0' . $formname . '_' . $sresult [0] [0] . '_frm';
		$sql = 'select ' . $sresult [0] [0] . '_id from ' . $tablename . ' where ' . $formname . '_id in (' . $formid . ')';
		$sres = getResultArray ( $con, $sql );
		if (sizeof ( $sres ) > 0)
			deleteFileandImage ( $con, $stable, $sres [0] [0] . "," );
	}
	for($di = 0; $di < $numdetails; $di ++) {
		$nth = $relationdetails [$di] [2];
		$stable = $relationdetails [$di] [4];
		// if ($formname == 'table_6') {
		// $nth = $nth + 3;
		// }
		if ($formname == 'table_6_group') {
			continue;
		}
		if ($formname == $stable) {
			continue;
		}
		$relationid = $relationdetails [$di] [0];
		$relation = $relationdetails [$di] [5];
		$tablename = $nth . $formname . '_' . $stable . '_frm';	
		$deletesubsql = 'delete from ' . $tablename . ' where ' . $formname . '_id in (' . $formid . ')';					
		if ($relation == '1-n') {
			$revdetail = findRevRelationDetail ( $con, $formname, $stable, $relationid );
			$revnth = $revdetail [2];
			if($revnth != ""){
			execSQL ( $con, $deletesubsql );
			$currenttime = date ( "Y-m-d H:i:s" );
			$sql = 'update ' . $stable . '_frm set ' . $formname . '_' . $revnth . '_' . $formname . '_id = NULL,updatedon = "' . $currenttime . '" where ' . $formname . '_' . $revnth . '_' . $formname . '_id in (' . $formid . ');';
			execSQL ( $con, $sql );
			insertSyncQueryDetails ( $con, $stable . "_frm", "", DB_ACTION::$UPDATE, $sql );
			}			
		}else{
		execSQL ( $con, $deletesubsql );
		}
	}
	$relationdetails = findSubtableRevRelationDetail ( $con, $formname );
	$numdetails = sizeof ( $relationdetails );
	for($di = 0; $di < $numdetails; $di ++) {
		$nth = $relationdetails [$di] [2];
		$stable = $relationdetails [$di] [4];
		$relation = $relationdetails [$di] [5];		
		$isrollingupdatefield = $relationdetails [$di] [9];
		if ($isrollingupdatefield == 1)
			continue;
		$hSformname = getHStructureFormName ( $con, $stable );
		if ($hSformname != '') {
			$stable = $hSformname;
		}
		if ($stable == 'table_6_group') {
			continue;
		}
		if ($formname == $stable) {
			continue;
		}
		$tablename = $nth . $stable . '_' . $formname . '_frm';
		$tablesql = "show tables like '$tablename';";
		$tablelist = getResultArray($con, $tablesql);
		if (sizeof($tablelist) > 0) {
		$sql = 'delete from ' . $tablename . ' where ' . $formname . '_id in (' . $formid . ')';
		execSQL ( $con, $sql );
		}		
	}
}
function getFormNameFromTableName($tablename) {
	$len = strlen ( $tablename ) - strlen ( BuilderKey::$TABLE_EXDENTION );
	$frmname = substr ( $tablename, 0, $len );
	return $frmname;
}
function getFormFieldValue($con, $formname, $fieldname, $tableid) {
	$sql = 'select ' . $fieldname . ' from ' . $formname . '_frm where ' . $formname . '_id=' . '\'' . $tableid . '\'';
	$retArr = getResultArray ( $con, $sql );
	$retArrCount = sizeof ( $retArr );
	$fieldvalue = '';
	for($retindex = 0; $retindex < $retArrCount; $retindex ++) {
		$row = $retArr [$retindex];
		$fieldvalue = $row [0];
		break;
	}
	return $fieldvalue;
}
function printlog_array($msg, $array) {
	$nume = sizeof ( $array );
	displaylogmsg ( '<<<<<start ' . $msg . '>>>>>>>>>' );
	for($i = 0; $i < $nume; $i ++) {
		displaylogmsg ( '<<<<<' . $i . '>>>>>>' . $array [$i] );
	}
	displaylogmsg ( '<<<<<end ' . $msg . '>>>>>>>>>' );
}
function isLogEnabled($appid) {
	$islogneeded = false;
	$logappid = trim ( LOGINFO::$LOG_APPID );
	if ($logappid == "All") {
		$islogneeded = true;
	} else if ($appid == $logappid) {
		$islogneeded = true;
	} else if ($appid == "" && $logappid == "cpanel") {
		$islogneeded = true;
	} else if (strpos ( $logappid, ',' )) {
		$appidarr = stringSplitByDelimit ( $logappid, ',' );
		for($i = 0; $i < sizeof ( $appidarr ); $i ++) {
			if ($appid == $appidarr [$i]) {
				$islogneeded = true;
				break;
			} else if ($appid == "" && $appidarr [$i] == "cpanel") {
				$islogneeded = true;
				break;
			}
		}
	}
	return $islogneeded;
}
function isSqlLogEnabled($appid, $con) {
	$issqllogneeded = 'true';
	if ($appid == '') {
		$sql = 'select iscpanellogneed from ' . DBINFO::$APPDBNAME . '.serverconfig;';
		$resArr = getResultArray ( $con, $sql );
		$sqllogstatus = $resArr [0] [0];
	} else {
		$sql = 'select f15 from ' . DBINFO::$APPDBNAME . '.applicationlist where appid = ' . '\'' . $appid . '\'';
		$resArr = getResultArray ( $con, $sql );
		$sqllogstatus = $resArr [0] [0];
	}
	if ($sqllogstatus == '1') {
		return true;
	} else {
		return false;
	}
	return true;
}
function isCronLogEnabled($appid, $con) {
	$sql = 'select f14 from ' . DBINFO::$APPDBNAME . '.applicationlist where appid = ' . '\'' . $appid . '\'';
	$resArr = getResultArray ( $con, $sql );
	$cronlogstatus = $resArr [0] [0];
	if ($cronlogstatus == '1') {
		return true;
	} else {
		return false;
	}
	return true;
}
function isErrorLogEnabled($appid, $con) {
	if ($appid == '') {
		$sql = 'select iscpanellogneed from ' . DBINFO::$APPDBNAME . '.serverconfig;';
		$resArr = getResultArray ( $con, $sql );
		$errorlogstatus = $resArr [0] [0];
	} else {
		if (isset ( $GLOBALS [$appid . "_iserrorlog"] )) {
			$errorlogstatus = $GLOBALS [$appid . "_iserrorlog"];
		} else {
			$sql = 'select f16 from ' . DBINFO::$APPDBNAME . '.applicationlist where appid = ' . '\'' . $appid . '\'';
			$resArr = getResultArray ( $con, $sql );
			$errorlogstatus = $resArr [0] [0];
			$GLOBALS [$appid . "_iserrorlog"] = $errorlogstatus;
		}
	}
	if ($errorlogstatus == '1') {
		return true;
	} else {
		return false;
	}
	return true;
}
function getLogFolderbase() {
	$currdirectory = getcwd ();
	if (strpos ( $currdirectory, 'hosted' )) {
		$stringarr = explode ( 'hosted', $currdirectory );
		if (sizeof ( $stringarr ) > 0) {
			$currdirectory = "/var/tmp";
		}
	}
	if (strpos ( $currdirectory, 'cpanel/dacamwebbuilder' )) {
		$currdirectory = str_replace ( "cpanel/dacamwebbuilder", "log", $currdirectory );
	} else if (strpos ( $currdirectory, 'dacamweb' )) {
		$currdirectory = str_replace ( "dacamweb", "log", $currdirectory );
	} else {
		$currdirectory .= "/log";
	}
	if (! is_dir ( $currdirectory )) {
		$old = umask ( 0 );
		mkdir ( $currdirectory, 0777, true );
		umask ( $old );
	}
	return $currdirectory;
}
function getFolderbase() {
	$currdirectory = getcwd ();
	if (strpos ( $currdirectory, 'cpanel/dacamwebbuilder' )) {
		$currdirectory = str_replace ( "cpanel/dacamwebbuilder", "", $currdirectory );
	} else {
		$currdirectory = str_replace ( "dacamweb", "", $currdirectory );
	}
	return $currdirectory;
}
function removeAllFolderContents($dir) {
	$files = glob ( $dir . '*', GLOB_MARK );
	foreach ( $files as $file ) {
		if (substr ( $file, - 1 ) == '/')
			removeAllFolderContents ( $file );
		else
			unlink ( $file );
	}
	rmdir ( $dir );
}
function displaylogmsg($msg) {
	$appid = getAppid ();
	if (LOGINFO::$ISLOGENABLED) {
		$currenttime = date ( 'Y-m-d H:i:s' );
		$remoteAdd = 'LOCALHOST';
		if (isset ( $_SERVER ['REMOTE_ADDR'] )) {
			$remoteAdd = $_SERVER ['REMOTE_ADDR'];
			if ($remoteAdd == '::1') {
				$remoteAdd = 'localhost';
			}
		}
		$basepath = getLogFolderbase ();
		if ($appid != '') {
			$logdir = $basepath . '/' . $appid;
		} else {
			$logdir = $basepath . '/general';
		}
		if (! is_dir ( $logdir )) {
			$old = umask ( 0 );
			mkdir ( $logdir, 0777, true );
			umask ( $old );
		}
		$logfile = 'debugerror.log';
		// date_default_timezone_set('Asia/Calcutta');
		if (isset ( $_SERVER ['REQUEST_URI'] )) {
			$baseurl = $_SERVER ['REQUEST_URI'];
			if (strpos ( $baseurl, 'hosted' ) > 1) {
				$logfile = 'debugerror_h.log';
			}
		}
		$logfilesize = getLogFileSize ( $logdir . '/' . $logfile );
		if ($logfilesize > LOGINFO::$DEFAULT_FILE_SIZE) {
			$filepath = $logdir . '/' . $logfile;
			createLogZipfile ( $logdir, $logfile );
			if (file_exists ( $filepath )) {
				$old = umask ( 0 );
				unlink ( $filepath );
				umask ( $old );
			}
		}
		if (is_dir ( $logdir )) {
			$old = umask ( 0 );
			error_log ( $remoteAdd . ' : ' . $currenttime . ' : ' . $msg . "\n", 3, $logdir . '/' . $logfile );
			umask ( $old );
		}
	}
}
function displaysqllogmsg($msg) {
	$appid = getAppid ();
	if (LOGINFO::$ISSQLLOGENABLED) {
		$currenttime = date ( 'Y-m-d H:i:s' );
		$remoteAdd = 'LOCALHOST';
		if (isset ( $_SERVER ['REMOTE_ADDR'] )) {
			$remoteAdd = $_SERVER ['REMOTE_ADDR'];
			if ($remoteAdd == '::1') {
				$remoteAdd = 'localhost';
			}
		}
		$basepath = getLogFolderbase ();
		if ($appid != '') {
			$logdir = $basepath . '/' . $appid;
		} else {
			$logdir = $basepath . '/general';
		}
		if (! is_dir ( $logdir )) {
			$old = umask ( 0 );
			mkdir ( $logdir, 0777, true );
			umask ( $old );
		}
		$logfile = 'debugsql.log';
		// date_default_timezone_set('Asia/Calcutta');
		if (isset ( $_SERVER ['REQUEST_URI'] )) {
			$baseurl = $_SERVER ['REQUEST_URI'];
			if (strpos ( $baseurl, 'hosted' ) > 1) {
				$logfile = 'debugsql_h.log';
			}
		}
		$logfilesize = getLogFileSize ( $logdir . '/' . $logfile );
		if ($logfilesize > LOGINFO::$DEFAULT_FILE_SIZE) {
			$filepath = $logdir . '/' . $logfile;
			createLogZipfile ( $logdir, $logfile );
			if (file_exists ( $filepath )) {
				$old = umask ( 0 );
				unlink ( $filepath );
				umask ( $old );
			}
		}
		if (is_dir ( $logdir )) {
			$old = umask ( 0 );
			error_log ( $remoteAdd . ' : ' . $currenttime . ' : ' . $msg . "\n", 3, $logdir . '/' . $logfile );
			umask ( $old );
		}
	}
}
function debugsync($msg) {
	$appid = getAppid ();
	if (LOGINFO::$ISSYNCLOGENABLED) {
		$currenttime = date ( 'Y-m-d H:i:s' );
		$remoteAdd = 'LOCALHOST';
		if (isset ( $_SERVER ['REMOTE_ADDR'] )) {
			$remoteAdd = $_SERVER ['REMOTE_ADDR'];
			if ($remoteAdd == '::1') {
				$remoteAdd = 'localhost';
			}
		}
		$basepath = getLogFolderbase ();
		if ($appid != '') {
			$logdir = $basepath . '/' . $appid;
		} else {
			$logdir = $basepath . '/general';
		}
		if (! is_dir ( $logdir )) {
			$old = umask ( 0 );
			mkdir ( $logdir, 0777, true );
			umask ( $old );
		}
		$logfile = 'debugsync.log';
		// date_default_timezone_set('Asia/Calcutta');
		if (isset ( $_SERVER ['REQUEST_URI'] )) {
			$baseurl = $_SERVER ['REQUEST_URI'];
			if (strpos ( $baseurl, 'hosted' ) > 1) {
				$logfile = 'debugsync_h.log';
			}
		}
		$logfilesize = getLogFileSize ( $logdir . '/' . $logfile );
		if ($logfilesize > LOGINFO::$DEFAULT_FILE_SIZE) {
			$filepath = $logdir . '/' . $logfile;
			createLogZipfile ( $logdir, $logfile );
			if (file_exists ( $filepath )) {
				$old = umask ( 0 );
				unlink ( $filepath );
				umask ( $old );
			}
		}
		if (is_dir ( $logdir )) {
			$old = umask ( 0 );
			error_log ( $remoteAdd . ' : ' . $currenttime . ' : ' . $msg . "\n", 3, $logdir . '/' . $logfile );
			umask ( $old );
		}
	}
}
function getLogFileSize($filepath) {
	$filesize = 0;
	try {
		if (file_exists ( $filepath )) {
			$filesize = filesize ( $filepath );
			$filesize = round ( $filesize / 1048576, 2 );
		}
	} catch ( Exception $exp ) {
		$filesize = 0;
	}
	return $filesize;
}
function createLogZipfile($folderpath, $filename) {
	$zip = new ZipArchive ();
	if (is_dir ( $folderpath )) {
		$archive_file_name = $filename . '.zip';
		$archive_folder_path = $folderpath . '/' . $archive_file_name;
		if (file_exists ( $archive_folder_path )) {
			unlink ( $archive_folder_path );
		}
		$createdstatus = $zip->open ( $archive_folder_path, ZIPARCHIVE::CREATE );
		if ($createdstatus !== TRUE) {
			exit ( 'cannot open <' . $archive_folder_path . '</br>' );
		} else {
			$filepath = $folderpath . '/' . $filename;
			if (file_exists ( $filepath )) {
				$zip->addFile ( $filepath, $filename );
			}
		}
		$zip->close ();
		if (file_exists ( $filepath )) {
			$old = umask ( 0 );
			unlink ( $filepath );
			umask ( $old );
		}
	}
}
function downloadBackupFile($applid) {
	$count = sizeof ( $applid );
	try {
		if ($count == 1) {
			$appid = $applid [0];
			$username = getDBUser ();
			$hostname = getDBHost ();
			$pwd = getDBPass ();
			$currenttime = date ( 'Y-m-d_H:i:s' );
			$filename = $appid . '_' . $currenttime . '.sql';
			$folderpath = getcwd () . DIRECTORY_SEPARATOR . 'tmp';
			if (! is_dir ( $folderpath )) {
				$old = umask ( 0 );
				mkdir ( $folderpath );
				umask ( $old );
			}
			chmod ( $folderpath, 0755 );
			$filepath = $folderpath . DIRECTORY_SEPARATOR . $filename;
			$old = umask ( 0 );
			$dumpCommand = 'mysqldump -h ' . $hostname . ' -u ' . $username . ' --skip-tz-utc --password=' . $pwd . " -P " . DBINFO::$PORT . ' ' . DBINFO::$APPDBNAME . $appid . ' >  ' . $filepath;
			exec ( $dumpCommand );
			umask ( $old );
			createLogZipfile ( $folderpath, $filename );
			$archive_file_name = $filename . '.zip';
			$archive_folder_path = $folderpath . '/' . $archive_file_name;
			if (file_exists ( $archive_folder_path )) {
				header ( 'Content-type: application/zip' );
				header ( 'Content-Disposition: attachment; filename=' . $archive_file_name );
				header ( 'Content-Transfer-Encoding: binary' );
				header ( 'Pragma: no-cache' );
				header ( 'Expires: 0' );
				set_time_limit ( 0 );
				readfile ( $archive_folder_path );
				if (file_exists ( $archive_folder_path )) {
					$old = umask ( 0 );
					unlink ( $archive_folder_path );
					umask ( $old );
				}
				exit ();
			}
		} else {
			setError ( 'Backup option only for single database' );
		}
	} catch ( Exception $exp ) {
		$msg = $exp->getMessage ();
		setError ( $msg );
	}
}

function downloadBackupFilewithoutdata($con, $applid) {
	$count = sizeof ( $applid );
	try {
		if ($count == 1) {
			$appid = $applid [0];
			$sql = "select formname from " . DBINFO::$APPDBNAME . $appid . ".formtable where modulename in ('Setup','Settings');";
			$setuptablesarr = getResultArray ( $con, $sql );
			$formnamestr = "application emailtemplate formactiontable formfieldreference formfieldtable formrelationtable formtable ft_detail ft_links ft_list generalsettings idgenerator liverecordconfigtable moduletable newconditiontable newsystemactiontable newtriggertable picklisttable searchtemplate table_2_frmaction table_2_frmscreen table_2_frmfields table_6_group_mapping triggerconditiontable triggersystemactiontable triggertable reportaccesstable reportdsforms reportdstable reportfieldtable reportfilterfieldtable reportform reportgroupdetailtable reportgrouptable reportmodule reportscheduler reportsubmodule  refferedfielddetails remotedbconnections remotereffieldmapping formwisemodifiedddetails  formhistoryfieldmap addonforms addonformactions autoprefixid scoringruledetails colorformatting dashboardaccesstable dashboardform dashboardmodule distributionruledetails imagetable importcustommapping mapviewdetails primarydashboarddetails printtemplate roleaccesstable smstemplate subtable_searchtemplate workflowconfig emailscantable emailscanfieldtable escanparsertable escanruletable cloudtelephoneyconfig";
			for($i = 0; $i < sizeof ( $setuptablesarr ); $i ++) {
				$formnametablename = $setuptablesarr [$i] [0];
				$pos = strpos ( $formnametablename, "table_" );
				if ($pos === false) {
					// do nothing
				} else {
					$formnametablename = $formnametablename . "_frm";
					$query = "SHOW TABLES LIKE '" . $formnametablename . "';";
					if (sizeof ( getResultArray ( $con, $query ) ) > 0) {
						$formnamestr = $formnamestr." ".$formnametablename;
					}
				}
			}
			$currenttime = date ( 'Y-m-d_H:i:s' );
			$filename = $appid . '_' . $currenttime . '.sql';
			$folderpath = getcwd () . DIRECTORY_SEPARATOR . 'tmp';
			if (! is_dir ( $folderpath )) {
				$old = umask ( 0 );
				mkdir ( $folderpath );
				umask ( $old );
			}
			chmod ( $folderpath, 0755 );
			$filepath = $folderpath . DIRECTORY_SEPARATOR . $filename;
			$old = umask ( 0 );
			$dumpCommand = "mysqldump --skip-lock-tables --no-data -h " . getDBHost () . " -u " . getDBUser () . " --compatible=ansi --skip-tz-utc --password=" . getDBPass () . " -P " . DBINFO::$PORT . " " . DBINFO::$APPDBNAME . $appid . " >  $filepath";
			exec ( $dumpCommand );
			$dumpCommand = "mysqldump --no-create-info --add-drop-table --skip-lock-tables --disable-keys --extended-insert --add-locks -h " . getDBHost () . " -u " . getDBUser () . " -P " . DBINFO::$PORT . " --compatible=ansi --skip-tz-utc --password=" . getDBPass () . " " . DBINFO::$APPDBNAME . $appid . " " . $formnamestr . "  >>  $filepath";
			exec ( $dumpCommand );
			chmod ( $folderpath, 0777 );
			if (file_exists ( $filepath )) {
				$deleline = "delete from table_6_frm where name != 'sadmin';";
				file_put_contents($filepath, $deleline, FILE_APPEND);
			}
			umask ( $old );
			createLogZipfile ( $folderpath, $filename );
			$archive_file_name = $filename . '.zip';
			$archive_folder_path = $folderpath . '/' . $archive_file_name;
			if (file_exists ( $archive_folder_path )) {
				header ( 'Content-type: application/zip' );
				header ( 'Content-Disposition: attachment; filename=' . $archive_file_name );
				header ( 'Content-Transfer-Encoding: binary' );
				header ( 'Pragma: no-cache' );
				header ( 'Expires: 0' );
				set_time_limit ( 0 );
				readfile ( $archive_folder_path );
				if (file_exists ( $archive_folder_path )) {
					$old = umask ( 0 );
					unlink ( $archive_folder_path );
					umask ( $old );
				}
				exit ();
			}
		} else {
				setError ( 'Backup option only for single database' );
		}
	} catch ( Exception $exp ) {
		$msg = $exp->getMessage ();
		setError ( $msg );
	}
}
function validateDateFormat($format) {
	$errormsg = '';
	if (strpos ( $format, '-' )) {
		$formatarr = stringSplitByDelimit ( $format, '-' );
	} else if (strpos ( $format, '/' )) {
		$formatarr = stringSplitByDelimit ( $format, '/' );
	} else {
		$errormsg = 'Invalid DateFormat! Supported Date Formats :  year - yyyy  month - mm  date - dd.  Ex: dd-MM-yyyy (or) dd/MM/yyyy';
	}
	if ($errormsg == '') {
		if (sizeof ( $formatarr ) != 3) {
			$errormsg = 'Invalid DateFormat! Supported Date Formats :  year - yyyy  month - mm  date - dd.  Ex: dd-MM-yyyy (or) dd/MM/yyyy';
		} else {
			$month = false;
			$date = false;
			$year = false;
			for($i = 0; $i < sizeof ( $formatarr ); $i ++) {
				$datef = strtolower ( $formatarr [$i] );
				if ($datef == 'mm') {
					$month = true;
				}
				if ($datef == 'dd') {
					$date = true;
				}
				if ($datef == 'yyyy') {
					$year = true;
				}
			}
			if (! $month || ! $date || ! $year) {
				$errormsg = 'Invalid DateFormat! Supported Date Formats :  year - yyyy  month - mm  date - dd.  Ex: dd-MM-yyyy (or) dd/MM/yyyy';
			}
		}
	}
	return $errormsg;
}
function EndsWith($FullStr, $EndStr) {
	$StrLen = strlen ( $EndStr );
	$FullStrEnd = substr ( $FullStr, strlen ( $FullStr ) - $StrLen );
	return $FullStrEnd == $EndStr;
}
function string_begins_with($string, $search) {
	if (strncmp ( $string, $search, strlen ( $search ) ) == 0) {
		return true;
	} else {
		return false;
	}
}
function getDefaultPrintTemplateContent($con, $formname) {
	$retcontent = '';
	$sql = 'select content from printtemplate where formname=' . '\'' . $formname . '\'' . ' and isdefault=1';
	$rows = getResultArray ( $con, $sql );
	if (sizeof ( $rows ) > 0) {
		$retcontent = html_entity_decode ( $rows [0] [0] );
	}
	return $retcontent;
}
function isActiveUser($con, $id) {
	$sql = 'select * from table_6_frm where table_6_id = ' . '\'' . $id . '\'' . ' and Account_Status = ' . '\'' . 'Active' . '\'';
	$dbrow = getResultArray ( $con, $sql );
	return sizeof ( $dbrow ) == 0 ? false : true;
}
function getPrintTemplateContents($con, $formname) {
	$retcontent = array ();
	$sql = 'select name,content,isdefault,rsneeded,roundoff,filename from printtemplate where formname=' . '\'' . $formname . '\'';
	$rows = getResultArray ( $con, $sql );
	for($i = 0; $i < sizeof ( $rows ); $i ++) {
		$tempdetail = array ();
		$tempdetail [] = $rows [$i] [0];
		$tempdetail [] = html_entity_decode ( $rows [$i] [1] );
		$tempdetail [] = $rows [$i] [2];
		$tempdetail [] = $rows [$i] [3];
		$tempdetail [] = $rows [$i] [4];
		$tempdetail [] = $rows [$i] [5];
		$retcontent [] = $tempdetail;
	}
	return $retcontent;
}
function getColorFormats($con, $formname) {
	$sql = 'select ft.modulename , pt.*  from colorformatting pt left join formtable ft on pt.formname = ft.formname where ft.formname=' . '\'' . $formname . '\'' . ';';
	return getResultArray ( $con, $sql );
}
function getUniqueName($con, $formname, $idname) {
	$uniquename = '';
	$sql = 'select name from formfieldtable where formname=' . '\'' . $formname . '\'' . ' and type in(\'document\',\'document_multi\')' . ' order by fieldorder';
	$rows = getResultArray ( $con, $sql );
	if (sizeof ( $rows ) > 0) {
		$row = $rows [0];
		$uniquename = $row [0];
	}
	return $uniquename;
}
function processImportPng($con, $obj) {
	list ( $width, $height ) = getimagesize ( $_FILES ['importpngimage'] ['tmp_name'] );
	if ($width < 100 && $height < 100) {
		setError ( "Please upload 50x50 above resolution images" );
		return;
	}
	$target_path = getcwd () . DIRECTORY_SEPARATOR . '../Content/images' . DIRECTORY_SEPARATOR;
	$cpanelurl = 'cpanel/dacamwebbuilder/../';
	$target_path2 = str_replace ( $cpanelurl, '', $target_path );
	$appid = $obj->{'APPID'};
	if ($appid == "") {
		$appid = getAppid ();
	}
	$bucketname = getS3BucketName ();
	$issaveinaws = isS3Enabled ( $con, $appid );
	displaylogmsg ( "Bucket Name : " . $bucketname . 'Appid : ' . $appid . ' Save in AWS :' . $issaveinaws );
	if (move_uploaded_file ( $_FILES ['importpngimage'] ['tmp_name'], $target_path . basename ( $_FILES ['importpngimage'] ['name'] ) )) {
		$replaced_name = str_replace ( ' ', '_', basename ( $_FILES ['importpngimage'] ['name'] ) );
		rename ( $target_path . basename ( $_FILES ['importpngimage'] ['name'] ), $target_path . $replaced_name );
		if (copy ( $target_path . $replaced_name, $target_path2 . $replaced_name )) {
			displaylogmsg ( 'The file copied to ' . $target_path2 . $replaced_name . ' path' );
		}
	} else {
		echo 'There was an error uploading the file, please try again!';
	}
	if ($issaveinaws) {
		// if (!class_exists('S3')) {
		// require_once('process/S3.php');
		// }
		
		uploadFileToS3 ( $con, $bucketname, 'images/' . $replaced_name, getFolderBase () . strstr ( $target_path . $replaced_name, 'C' ), $appid );
	}
}
function getUniqueFieldValue($con, $formname, $id) {
	$sql = 'select name from formfieldtable where formname = ' . '\'' . $formname . '\'' . ' and isunique = ' . '\'' . '1' . '\'';
	$result = getResultArray ( $con, $sql );
	$fieldname = $result [0] [0];
	if ($fieldname == '') {
		$sql = 'select name from formfieldtable where formname = ' . '\'' . $formname . '\'' . ' and fieldorder = 1';
		$result = getResultArray ( $con, $sql );
		$fieldname = $result [0] [0];
	}
	$sql = 'select ' . $fieldname . ' from ' . $formname . '_frm where ' . $formname . '_id = ' . '\'' . $id . '\'';
	$dbrows = getResultArray ( $con, $sql );
	$fieldvalue = $dbrows [0] [0];
	return $fieldvalue;
}
function getApplicationDetailObj($con) {
	// return $_SESSION['appdetailObj'];
	$appid = getAppid ();
	if (isset ( $GLOBALS [$appid . "_sessiontime"] )) {
		$appdetail = $GLOBALS [$appid . "_sessiontime"];
	} else {
		$sql = "select * from " . DBINFO::$APPDBNAME . $appid . ".application";
		$rows = getResultArray ( $con, $sql );
		$appdetail = $rows [0];
		$GLOBALS [$appid . "_sessiontime"] = $appdetail;
	}
	return $appdetail;
}
function setApplicationdetails($con) {
	/*
	 * thjis is not useful as itshould be shared across all the users $sql = "select * from application"; $rows = getResultArray($con, $sql); $appdetail = $rows[0]; $_SESSION['appdetailObj'] = $appdetail;
	 */
}
function isEmailEnabled($con) {
	$sql = 'select Email_Status from table_21_frm;';
	$rows = getResultArray ( $con, $sql );
	$isemailenabled = $rows [0] [0];
	if ($isemailenabled == CHECKBOXVALUES::$ENABLED)
		return true;
	else
		return false;
}
function isSMSEnabled($con) {
	$sql = 'select SMS_Status from table_21_frm;';
	$rows = getResultArray ( $con, $sql );
	$issmsenabled = $rows [0] [0];
	if ($issmsenabled == CHECKBOXVALUES::$ENABLED)
		return true;
	else
		return false;
}
function getCurUserEmailId($con, $curuser) {
	$sql = 'select Emailid from table_6_frm where Name=' . '\'' . $curuser . '\'';
	$result = getResultArray ( $con, $sql );
	return $result [0] [0];
}
function getFontSize($colsize) {
	$fontsize = 10;
	if ($colsize > 5 && $colsize <= 10) {
		$fontsize = 9;
	} else if ($colsize > 10 && $colsize <= 15) {
		$fontsize = 7;
	} else if ($colsize > 15 && $colsize <= 20) {
		$fontsize = 4;
	} else if ($colsize > 20 && $colsize <= 25) {
		$fontsize = 3;
	} else if ($colsize > 25) {
		$fontsize = 2;
	}
	return $fontsize;
}
function exportPdf($con, $filename, $result, $header, $colsize) {
	// $appname = getApplicationName($con);
	$pdf = new TCPDF ( PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false );
	$pdf->setPageFormat ( 'A4', 'L' ); // P is Default Format and L is Land Scape
	ob_clean ();
	// set document information
	// $pdf->SetCreator(PDF_CREATOR);
	// set default header data
	// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $appname, "Powered by www.dacamsys.com");
	// $pdf->SetHeaderData("", "", " ".$appname);
	// set header and footer fonts
	$pdf->setHeaderFont ( Array (
			PDF_FONT_NAME_MAIN,
			'',
			PDF_FONT_SIZE_MAIN 
	) );
	$pdf->setFooterFont ( Array (
			PDF_FONT_NAME_DATA,
			'',
			PDF_FONT_SIZE_DATA 
	) );
	
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont ( PDF_FONT_MONOSPACED );
	
	// set margins
	$pdf->SetMargins ( PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT );
	$pdf->SetHeaderMargin ( PDF_MARGIN_HEADER );
	$pdf->SetFooterMargin ( PDF_MARGIN_FOOTER );
	
	// set auto page breaks
	$pdf->SetAutoPageBreak ( TRUE, PDF_MARGIN_BOTTOM );
	
	// set image scale factor
	$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
	
	// set some language-dependent strings
	// pdf->setLanguageArray($l);
	// ---------------------------------------------------------
	// set font
	$fontsize = 8;
	if ($colsize != "") {
		$fontsize = getFontSize ( $colsize );
	}
	// echo "colsize = ".$colsize."L=".$fontsize;
	$pdf->SetFont ( 'dejavusans', '', $fontsize );
	
	// add a page
	$pdf->AddPage ();
	
	// output the HTML content
	if ($header != '')
		$pdf->writeHTML ( $header, true, 0, true, 0 );
	$pdf->writeHTML ( $result, true, 0, true, 0 );
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// reset pointer to the last page
	$pdf->lastPage ();
	// ---------------------------------------------------------
	// Close and output PDF document
	$pdf->Output ( $filename . '.pdf', 'D' );
}
function convertnumbertocurrency($currencytype, $num) {
	$num = trim ( $num );
	$convnum = '';
	$isroundoffneeded=false;
	if ($num != '') {
		$curtype = explode ( ',', $currencytype );
		$curname = $curtype [0];
		$curvalue = $curtype [1];
		$num = number_format ( $num, 2, '.', '' );		
		if($isroundoffneeded){
		$num = round ( $num );	
		}  	
		$isnegativedigit = false;
		if ($num < 0) {
			$isnegativedigit = true;
			$num = $num * (- 1);
			if(strpos($num, '.') === false){
				$num=$num.".00";
			}
		}		
		if ($currencytype == 'INR,Rs.') {		
			if($isroundoffneeded){
				$intvalue = $num;
			}else{						
				$intvalue = substr($num, 0, strpos($num, '.'));				
				$fraction = $num - $intvalue;				
			}			
			$strint = '' . $intvalue;
			$numdigits = strlen ( $strint );
			$lastdigitprocessed = $numdigits;
			
			if ($numdigits > 3) {
				$lastdigitprocessed = $numdigits - 3;
				$thsoaund = substr ( $strint, $lastdigitprocessed );
				$convnum = $thsoaund;
			}			
			for($ri = 5; $ri <= $numdigits; $ri = $ri + 2) {
				$lastdigitprocessed = $numdigits - $ri;
				$twodigits = substr ( $strint, $numdigits - $ri, 2 );
				$convnum = $twodigits . ',' . $convnum;
			}			
			if ($lastdigitprocessed !== 0) {
				$remdigits = substr ( $strint, 0, $lastdigitprocessed );
				if ($remdigits != '') {
					if ($convnum != '')
						$convnum = $remdigits . ',' . $convnum;
					else
						$convnum = $remdigits;
				}
			}
			
			if ($fraction != '' || $fraction == 0) {		
			if($fraction == 0){					
				$fraction='.00';	
				}else{					
				$fraction = number_format($fraction, 2, '.', '');		
			$fraction = substr($fraction, 1);		
				}					
			$convnum = $convnum . $fraction;
			}			
		} else {
			$intvalue = ( int ) $num;
			$fraction = $num - $intvalue;
			$strint = '' . $intvalue;
			$numdigits = strlen ( $strint );
			$lastdigitprocessed = $numdigits;
			
			if ($numdigits > 3) {
				$lastdigitprocessed = $numdigits - 3;
				$thsoaund = substr ( $strint, $lastdigitprocessed );
				$convnum = $thsoaund;
			}
			for($ri = 6; $ri <= $numdigits; $ri = $ri + 3) {
				$lastdigitprocessed = $numdigits - $ri;
				$twodigits = substr ( $strint, $numdigits - $ri, 3 );
				$convnum = $twodigits . ',' . $convnum;
			}
			if ($lastdigitprocessed !== 0) {
				$remdigits = substr ( $strint, 0, $lastdigitprocessed );
				if ($remdigits != '') {
					if ($convnum != '')
						$convnum = $remdigits . ',' . $convnum;
					else
						$convnum = $remdigits;
				}
			}
			if ($fraction != '') {
				$fraction = number_format ( $fraction, 2, '.', '' );
				$fraction = substr ( $fraction, 1 );
				$convnum = $convnum . $fraction;
			}
		}	
		if ($isnegativedigit) {
			$convnum = '-' . $convnum;
		}
		if (isCurrencySymbolNeeded ()) {
			$convnum = $curvalue . '  ' . $convnum;
		}
	}
	return $convnum;
}
function populateCurrencyType($con) {
	$sql = 'select Default_Currency from table_21_frm;';
	$rows = getResultArray ( $con, $sql );
	$currencytype = $rows [0] [0];
	$_SESSION ['currencytype'] = $currencytype;
}
function getCurrencyType() {
	return $_SESSION ['currencytype'];
}
function getFormlableName($con, $formname) {
	$sql = 'select labelname from formtable where formname=' . '\'' . $formname . '\'' . ';';
	$rows = getResultArray ( $con, $sql );
	$lablename = $rows [0] [0];
	return $lablename;
}
function getFormNamefromLable($con, $formlabelname) {
	$sql = 'select formname from formtable where labelname=' . '\'' . $formlabelname . '\'' . ';';
	$rows = getResultArray ( $con, $sql );
	$formname = $rows [0] [0];
	return $formname;
}
function getFormNamefromLableForInventory($con, $formlabelname) {
	$sql = 'select formname from inventorytables where labelname = ' . '\'' . $formlabelname . '\'' . ';';
	$rows = getResultArray ( $con, $sql );
	$formname = $rows [0] [0];
	return $formname;
}
function execSQL($con, $sql) {
	displaysqllogmsg ( 'Sql Query : ' . $sql );
	$ret = $con->exec ( $sql );
	if(isset($_SESSION ['sqlcount'])){
	$_SESSION ['sqlcount'] = $_SESSION ['sqlcount'] + 1;	
	}else{
	$_SESSION ['sqlcount'] = 1;	
	}	
	return $ret;
}
function querySQL($con, $sql) {
	displaysqllogmsg ( 'Sql Query : ' . $sql );
	$ret = $con->query ( $sql );
	if(isset($_SESSION ['sqlcount'])){
	$_SESSION ['sqlcount'] = $_SESSION ['sqlcount'] + 1;	
	}else{
	$_SESSION ['sqlcount'] = 1;	
	}
	return $ret;
}
function getRelationDetailByRelationId($con, $relationid) {
	$sql = 'select * from  formrelationtable  where relationid=' . $relationid;
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows [0];
}
function getRelationDetailForField($con, $formname, $fieldname) {
	//$sql = 'select nthinstance, relation, indirectform, fft.relationid from formfieldtable  fft left join formrelationtable frt on fft.relationid= frt.relationid where  formname=' . '\'' . $formname . '\'' . ' and name=' . '\'' . $fieldname . '\'';
	//$dbrows = getResultArray ( $con, $sql );
	$dbrows=getRelationDetailForFieldFromSession($con, $formname, $fieldname);	
	return $dbrows [0];
}
function findNthInstance($con, $mform, $sform) {
	$sql = 'select nthinstance from formrelationtable where mtable=' . '\'' . $mform . '\'' . ' and stable=' . '\'' . $sform . '\'' . ';';
	$dbrows = getResultArray ( $con, $sql );
	$nth = $dbrows [0] [0];
	if (sizeof ( $dbrows ) > 1 && $sform != "table_6") {
		for($ni = 0; $ni < sizeof ( $dbrows ); $ni ++) {
			$nthins = $dbrows [$ni] [0];
			$base_Sub_tablename = $nthins . $mform . '_' . $sform . "_frm";
			$sql = "SELECT COUNT(1) FROM information_schema.tables WHERE table_name = '$base_Sub_tablename'";
			$resultrows = getResultArray ( $con, $sql );
			$count = $resultrows [0] [0];
			if ($count > 0) {
				$nth = $dbrows [$ni] [0];
			}
		}
	}
	if ($sform == "table_6" && $dbrows [3] [0] != "") {
		$nth = $dbrows [3] [0];
	}
	return $nth;
}
function findRevRelationDetail($con, $mform, $sform, $mrelationid) {
	$sql = 'select * from formrelationtable where mtable=' . '\'' . $sform . '\'' . ' and stable=' . '\'' . $mform . '\'' . ' and revrelationid=' . $mrelationid . ';';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows [0];
}
function getMobileDBErrorMsg($con, $status) {
	$sql = "select Message from Mobile_DB_ErrorMsg where status = '$status'";
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows [0] [0];
}
function findSubtableRevRelationDetail($con, $form) {
	$sql = 'select frt.*, fft.isrollingupdate from formrelationtable frt
    left join formfieldtable fft on fft.relationid=frt.relationid
    where mtable=' . '\'' . $form . '\'' . ' and relation like ' . '\'' . 'n%' . '\'' . '  and ((nthinstance>2 and stable=' . '\'' . 'table_6' . '\'' . ') or stable!=' . '\'' . 'table_6' . '\'' . ');';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows;
}
function findSubtableRelationDetail($con, $form) {
	$sql = 'select * from formrelationtable where mtable=' . '\'' . $form . '\'' . ' and relation like ' . '\'' . '%n' . '\'' . '  and ((nthinstance>2 and stable=' . '\'' . 'table_6' . '\'' . ') or (stable!=' . '\'' . 'table_6' . '\')' . ');';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows;
}
function findSubtableRelationDetailWithSForm($con, $form, $sform) {
	$sql = 'select * from formrelationtable where mtable=' . '\'' . $form . '\'' . ' and stable=' . '\'' . $sform . '\'' . ' and relation like ' . '\'' . '%n' . '\'' . '  and ((nthinstance>2 and stable=' . '\'' . 'table_6' . '\'' . ') or stable!=' . '\'' . 'table_6' . '\'' . ');';
	$dbrows = getResultArray ( $con, $sql );
	return $dbrows;
}
function findNextNthInstance($con, $mform, $sform) {
	$nextinstance = getNextIdValueWithCond ( $con, 'formrelationtable', 'nthinstance', 'mtable=' . '\'' . $mform . '\'' . ' and stable=' . '\'' . $sform . '\'' . ' ' );
	return $nextinstance;
}
function getAllFormHistoryFieldCondition() {
	return ' name =' . '\'' . 'table_6_0_createdusername' . '\'' . ' or
                name =' . '\'' . 'createdon' . '\'' . ' or
                name =' . '\'' . 'table_6_1_updatedusername' . '\'' . ' or
                name =' . '\'' . 'updatedon' . '\'' . ' or
                name =' . '\'' . 'table_6_2_viewedusername' . '\'' . ' or
                name =' . '\'' . 'viewedon' . '\'';
}
function getFormHistoryFieldCondition($formname) {
	$cruid = 0;
	$upuid = $cruid + 1;
	$viuid = $upuid + 1;
	return ' name !=' . '\'' . 'table_6_' . $cruid . '_createdusername' . '\'' . ' and
                name !=' . '\'' . 'createdon' . '\'' . ' and
                name !=' . '\'' . 'table_6_' . $upuid . '_updatedusername' . '\'' . ' and
                name !=' . '\'' . 'updatedon' . '\'' . ' and
                name !=' . '\'' . 'table_6_' . $viuid . '_viewedusername' . '\'' . ' and
                name !=' . '\'' . 'viewedon' . '\'';
}
function getSystemFieldsCount() {
	return 6;
}
function getSystemFields() {
	return array (
			'table_6_0_createdusername',
			'createdon',
			'table_6_1_updatedusername',
			'updatedon',
			'table_6_2_viewedusername',
			'viewedon' 
	);
}
function getSystemFieldLabels() {
	return array (
			'Created Username',
			'Created Time',
			'Updated Username',
			'Updated Time',
			'Viewed Username',
			'Viewed Time' 
	);
}
function getUserSystemFields() {
	return array (
			'table_6_0_createdusername',
			'createdon',
			'table_6_1_updatedusername',
			'updatedon',
			'table_6_2_viewedusername',
			'viewedon' 
	);
}
function getAppStatus($con) {
	$appdetail = getApplicationDetailObj ( $con );
	return trim ( $appdetail [13] );
}
function getSessionTime($con) {
	if (isset ( $GLOBALS [$appid . "_sessiontime"] )) {
		$resultrows [0] [0] = $GLOBALS [$appid . "_sessiontime"];
	} else {
		$sql = "select sessiontime from " . DBINFO::$APPDBNAME . ".serverconfig";
		$resultrows = getResultArray ( $con, $sql );
		$GLOBALS [$appid . "_sessiontime"] = $resultrows [0] [0];
	}
	return $resultrows [0] [0];
}
function isWriteOprationUnderMaintenance($con, $obj) {
	$iswiteop = false;
	$appdetail = getApplicationDetailObj ( $con );
	if (trim ( $appdetail [13] ) == 'Maintenance') {
		$iswiteop = isWriteOperation ( $con, $obj );
	}
	return $iswiteop;
}
function isWriteOperation($con, $obj) {
	if (isset ( $obj->{OPERATIONTYPE::$KEY} )) {
		$operation = $obj->{OPERATIONTYPE::$KEY};
		
		$listofwriteopeations = array ();
		$listofwriteopeations [] = OPERATIONTYPE::$SAVE;
		$listofwriteopeations [] = OPERATIONTYPE::$EDIT;
		$listofwriteopeations [] = OPERATIONTYPE::$DELETE;
		$listofwriteopeations [] = OPERATIONTYPE::$CHANGE;
		$listofwriteopeations [] = OPERATIONTYPE::$MASSEDIT;
		$listofwriteopeations [] = OPERATIONTYPE::$IMPORT;
		$listofwriteopeations [] = OPERATIONTYPE::$CUSTOM;
		
		$nops = sizeof ( $listofwriteopeations );
		for($oi = 0; $oi < $nops; $oi ++) {
			if ($operation == $listofwriteopeations [$oi]) {
				return true;
			}
		}
	}
	return false;
}

// function isImportProcessRunning($con) {
// $isrunning = false;
// $currentdatetime = date("Y-m-d H:i:s");
// $sql = "select * from importprocess;";
// $dbrows = getResultArray($con, $sql);
// if (sizeof($dbrows) > 0) {
// $updatedtime = $dbrows[0][1];
// $timediff = dateTimeDiff($updatedtime);
// if (sizeof($timediff)) {
// $hour = $timediff[0];
// $min = $timediff[1];
// $sec = $timediff[2];
// if ($hour == 0 && $min <= 3) {
// $isrunning = true;
// } else {
// deleteImportProcess($con);
// }
// }
// }
// return $isrunning;
// }
function deleteImportProcess($con) {
	$sql = 'delete from importprocess ;';
	$result = execSQL ( $con, $sql );
}
function addSaasInfoDetail($con, $inpfields) {
	$username = $inpfields->{'Emailid'};
	$currenttime = date ( 'Y-m-d H:i:s' );
	$appid = getAppid ();
	$appidarr=explode("_", $appid);
	$productid = getProductId ();
	$editionindex = getEditionIndex ();
	if(sizeof($appidarr) == 3){
	$productid=$appidarr[0];	
	$editionindex=$appidarr[1];	
	}
	$prodext = $productid."_".$editionindex."_";
	$sql = 'insert into   ' . DBINFO::$APPDBNAME . '.saasinfo values ( ' . '\'' . $username . '\'' . ' , ' . '\'' . $appid . '\'' . ',' . '\'' . '' . '\'' . ' );';
	$result = execSQL ( $con, $sql );
	$sql = 'insert into   ' . DBINFO::$APPDBNAME . '.' . $prodext . 'uservsapptable values ( ' . '\'' . $username . '\'' . ' ,' . '\'' . $username . '\'' . ' , ' . '\'' . $appid . '\'' . ',' . '\'' . $currenttime . '\'' . ',' . '\'' . '' . '\'' . ',' . '\'' . '' . '\'' . ' );';
	$result = execSQL ( $con, $sql );
	$sql = 'insert into   ' . DBINFO::$APPDBNAME . '.' . $productid . '_editionreg values ( ' . '\'' . $appid . '\'' . ' ,' . '\'' . $editionindex . '\'' . ' , ' . '\'' . $username . '\'' . ' );';
	$result = execSQL ( $con, $sql );
}
function updateSaasInfoDetail($con, $inpfields) {
	$username = $inpfields->{'Emailid'};
	$ousername = $inpfields->{"PrevEmailid"};
	$currenttime = date ( 'Y-m-d H:i:s' );
	$appid = getAppid ();
	$appidarr=explode("_", $appid);
	$productid = getProductId ();
	$editionindex = getEditionIndex ();
	if(sizeof($appidarr) == 3){
	$productid=$appidarr[0];	
	$editionindex=$appidarr[1];	
	}
	$prodext = $productid."_".$editionindex."_";
	if ($username != "") {
		$sql = 'update ' . DBINFO::$APPDBNAME . '.' . $prodext . 'uservsapptable set saasuserid = \'' . $username . '\', crmuserid = \'' . $username . '\' where saasuserid = \'' . $ousername . '\'';
		$result = execSQL ( $con, $sql );
	}
}
function createOrganizationTable($con, $appid) {
	$tablename = $appid . '_table_21_frm';
	$sql = 'show tables like ' . '\'' . $tablename . '\'';
	$dbrows = getResultArray ( $con, $sql );
	$tableid = 'table_21_id';
	if (sizeof ( $dbrows ) == 0) {
		$sql = 'CREATE TABLE  ' . DBINFO::$APPDBNAME . '.`' . $tablename . '` (
                `' . $tableid . '` varchar(30) NOT NULL,
                `Organization_Name` varchar(60) DEFAULT ' . '\'' . '' . '\'' . ',
                `Logo` varchar(30) DEFAULT ' . '\'' . 'logo.png' . '\'' . ',
                `Address` varchar(300) DEFAULT ' . '\'' . '' . '\'' . ',
                `Email_Id` varchar(30) DEFAULT ' . '\'' . '' . '\'' . ',
                `Phone_No_1` varchar(30) DEFAULT ' . '\'' . '' . '\'' . ',
                `Phone_No_2` varchar(30) DEFAULT ' . '\'' . '' . '\'' . ',
                `Website` varchar(30) DEFAULT ' . '\'' . '' . '\'' . ',
                `Fax` varchar(30) DEFAULT ' . '\'' . '' . '\'' . ',
                `Financial_Year_Start` varchar(30) DEFAULT ' . '\'' . '' . '\'' . ',
                `Default_Currency` varchar(30) DEFAULT ' . '\'' . '' . '\'' . ',
                `Email_Status` varchar(30) DEFAULT ' . '\'' . '' . '\'' . ',
                `SMS_Status` varchar(30) DEFAULT ' . '\'' . '0' . '\'' . ',
                `Date_Format` varchar(30) DEFAULT ' . '\'' . '0' . '\'' . ',
                `Time_Zone` varchar(30) DEFAULT ' . '\'' . '' . '\'' . ',
                `table_6_0_table_6_id` varchar(30) DEFAULT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                `table_6_1_table_6_id` varchar(30) DEFAULT NULL,
                `updatedon` timestamp NOT NULL DEFAULT ' . '\'' . '0000-00-00 00:00:00' . '\'' . ',
                `table_6_2_table_6_id` varchar(30) DEFAULT NULL,
                `viewedon` timestamp NOT NULL DEFAULT ' . '\'' . '0000-00-00 00:00:00' . '\'' . ',
                PRIMARY KEY (`$tableid`),
                UNIQUE KEY `Organization_Name` (`Organization_Name`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
		$result = execSQL ( $con, $sql );
		// $sql = 'ALTER TABLE ' . DBINFO::$APPDBNAME . '.`' . $tablename . '` ADD COLUMN `Number_of_User` varchar(30) AFTER `viewedon`;';
		// $result = execSQL($con, $sql);
		// $sql = 'ALTER TABLE ' . DBINFO::$APPDBNAME . '.`' . $tablename . '` MODIFY Number_of_User varchar(30) AFTER Time_Zone;';
		// $result = execSQL($con, $sql);
		// $sql = 'ALTER TABLE ' . DBINFO::$APPDBNAME . '.`' . $tablename . '` ADD COLUMN `Remaining_User` varchar(30) AFTER `Number_of_User`;';
		// $result = execSQL($con, $sql);
		// $sql = 'ALTER TABLE ' . DBINFO::$APPDBNAME . '.`' . $tablename . '` ADD COLUMN `Total_Active` varchar(30) AFTER `Remaining_User`;';
		// $result = execSQL($con, $sql);
		// $sql = 'ALTER TABLE ' . DBINFO::$APPDBNAME . '.`' . $tablename . '` ADD COLUMN `Total_Record_Count` varchar(30) AFTER `Total_Active`;';
		// $result = execSQL($con, $sql);
		// $sql = 'ALTER TABLE ' . DBINFO::$APPDBNAME . '.`' . $tablename . '` ADD COLUMN `Total_Storage_Size` varchar(30) AFTER `Total_Record_Count`;';
		// $result = execSQL($con, $sql);
	}
}
function getSaasProductExt() {
	$prodext = '';
	$productid = getProductId ();
	if ($productid != null || $productid != "") {
		$editionindex = getEditionIndex ();
		if ($editionindex == '') {
			$editionindex = 0;
		}
		$prodext = $productid . '_' . $editionindex . '_';
	}else{
		$appid = getAppid ();
		$appidarr=explode("_", $appid);
		if(sizeof($appidarr) == 3){
		$prodext = $appidarr[0] . '_' . $appidarr[1] . '_';	
		}
	}
	return $prodext;
}
function getSaasUserName($con, $obj) {
	$emailid = $obj->{'useremail'};
	$prodext = getSaasProductExt ();
	$sql = 'select * from ' . DBINFO::$APPDBNAME . '.' . $prodext . 'orginfo where emailid=' . '\'' . $emailid . '\'';
	$resu = getResultArray ( $con, $sql );
	if (sizeof ( $resu ) > 0) {
		return sizeof ( $resu );
	} else {
		return NULL;
	}
}
function getSaasCompanyName($con, $obj) {
	$companyname = $obj->{'companyname'};
	$prodext = getSaasProductExt ();
	$sql = 'select * from ' . DBINFO::$APPDBNAME . '.' . $prodext . 'orginfo where companyname=' . '\'' . $companyname . '\'';
	$resu = getResultArray ( $con, $sql );
	if (sizeof ( $resu ) > 0) {
		return sizeof ( $resu );
	} else {
		return NULL;
	}
}
function getSaasUserid($con, $obj) {
	$userid = $obj->{'username'};
	$prodext = getSaasProductExt ();
	$sql = 'select * from ' . DBINFO::$APPDBNAME . '.' . $prodext . 'uservsapptable where saasuserid=' . '\'' . $userid . '\'';
	$resu = getResultArray ( $con, $sql );
	if (sizeof ( $resu ) > 0) {
		return sizeof ( $resu );
	} else {
		return NULL;
	}
}
function insertFreeAppIdForNormalProcess($con, $productid, $editionindex) {
	$tablename = DBINFO::$APPDBNAME . "." . $productid . '_' . $editionindex . '_freeappidtable';
	$sql = "select count(1),max(appid) from $tablename";
	$dbrow = getResultArray ( $con, $sql );
	$count = $dbrow [0] [0];
	$maxcount = $dbrow [0] [1];
	if ($maxcount == NULL)
		$maxcount = - 1;
	if ($count < SAASDETAILS::$NUMBEROFFREEDB) {
		$neededcount = SAASDETAILS::$NUMBEROFFREEDB - $count;
		for($i = 0; $i < $neededcount; $i ++) {
			$sql = "insert into $tablename values ('" . ++ $maxcount . "','')";
			$result = execSQL ( $con, $sql );
		}
	}
}
function insertRegistrationDetails($con, $obj) {
	try {
		// startTransaction($con);
		$productid = getProductId ();
		$editionindex = getEditionIndex ();
		$prodext = getSaasProductExt ();
		$tablename = DBINFO::$APPDBNAME . "." . $productid . '_' . $editionindex . '_freeappidtable';
		$sql = 'select min(appid) from ' . $tablename . ' where schemastatus = ' . '\'' . 'Created' . '\'';
		$resultrow = getResultArray ( $con, $sql );
		$id = $resultrow [0] [0];
		$nextid = getNextIdValue ( $con, "table_6_frm", "table_6_id" );
		$productname = getProductNameFromProductId ( $con, $productid );
		if ($id != '') {
			startTransaction ( $con );
			$appid = $productid . '_' . $editionindex . '_' . $id;
			$regstatus = processRegistration ( $con, $obj, $appid, $productname, $nextid );
		} else {
			insertFreeAppIdForNormalProcess ( $con, $productid, $editionindex );
			$sql = "select min(appid) from $tablename where schemastatus != 'Created'";
			$resultrow = getResultArray ( $con, $sql );
			$appid = $resultrow [0] [0];
			$id = $appid;
			$appid = $productid . '_' . $editionindex . '_' . $appid;
			$dbname = DBINFO::$APPDBNAME . $appid;
			if (APPINFO::$IS_BUILDER_APP) {
				$appid = $nextid;
				$dbname = $appid . "_" . DBINFO::$APPDBNAME;
			}
			$status = createSaasRegdatabase ( $con, $appid, $productid, $editionindex );
			if ($status) {
				startTransaction ( $con );
				$sql = "update $tablename set schemastatus = 'Created' where appid = '$id'";
				$result = execSQL ( $con, $sql );
				if (! APPINFO::$IS_BUILDER_APP) {
					$regstatus = processRegistration ( $con, $obj, $appid, $productname, $editionindex, $nextid );
					if (! $regstatus) {
						$sql = "drop database IF EXISTS $dbname";
						$result = execSQL ( $con, $sql );
					} else {
						if (APPINFO::$IS_BUILDER_APP) {
							$username = $obj->{'username'};
							$uid = $nextid;
							$foldername = $username . $uid;
							$dirctorypath = "./" . $foldername;
							$old = umask ( 0 );
							mkdir ( $dirctorypath, 0777 );
							$proname = getProductHtmlPageName ( $con, $productid, $productname );
							$file = './' . $proname;
							$newfile = $dirctorypath . '/index.html';
							$str = implode ( "", file ( $file ) );
							$fp = fopen ( $newfile, 'w' ) or debug ( "can't open file" );
							$str = str_replace ( "builderid=''", "builderid='$uid'", $str );
							$str = str_replace ( "href='", "href='../", $str );
							$str = str_replace ( "dacamwebbuilder/", "../cpanel/dacamwebbuilder/", $str );
							fwrite ( $fp, $str, strlen ( $str ) );
							$lanchpath = $foldername . "/index.html";
							updateLaunchpage ( $con, $appid, $lanchpath );
							$proname = strtolower ( $productname ) . '/login.php';
							$file = './' . $proname;
							$newfile = $dirctorypath . '/login.php';
							$str = implode ( "", file ( $file ) );
							$fp = fopen ( $newfile, 'w' ) or debug ( "can't open file" );
							$str = str_replace ( "name='builderid' value=''", "name='builderid' value='$uid'", $str );
							fwrite ( $fp, $str, strlen ( $str ) );
							umask ( $old );
						}
					}
				}
			}
		}
		// commitTransaction($con);
		clearTransactionCount ();
		return $regstatus;
	} catch ( Exception $ex ) {
		// rollbackTransaction($con);
		$msg = $ex->getMessage ();
		setError ( $msg );
		displaylogmsg ( $msg );
		return false;
	}
}
function updateLaunchpage($con, $appid, $newfile) {
	$sql = "update " . DBINFO::$APPDBNAME . ".applicationlist set f5='$newfile' where appid='$appid'";
	$result = execSQL ( $con, $sql );
}
function querySaasEditionIndex($con, $productid, $userid) {
	$sql = "select editionindex from " . DBINFO::$COMMONDBNAME . "." . $productid . "_editionreg where userid='$userid'";
	$resultrows = getResultArray ( $con, $sql );
	$editionindex = "";
	if (sizeof ( $resultrows ) > 0) {
		$editionindex = $resultrows [0] [0] + "";
	}
	return $editionindex;
}
function Zipcreator($folderpath, $filename) {
	$zip = new ZipArchive ();
	if (is_dir ( $folderpath )) {
		$archive_file_name = $filename . '.zip';
		$archive_folder_path = $folderpath . '/' . $archive_file_name;
		if (file_exists ( $archive_folder_path )) {
			unlink ( $archive_folder_path );
		}
		$createdstatus = $zip->open ( $archive_folder_path, ZIPARCHIVE::CREATE );
		if ($createdstatus !== TRUE) {
			exit ( 'cannot open <' . $archive_folder_path . '</br>' );
		} else {
			$filepath = $folderpath . '/' . $filename;
			if (file_exists ( $filepath )) {
				$zip->addFile ( $filepath, $filename );
			}
		}
		
		$zip->close ();
	}
}
function getProductNameFromProductId($con, $productid) {
	$sql = "select productname from " . DBINFO::$COMMONDBNAME . ".productdetails where product_id ='$productid'";
	$resultrows = getResultArray ( $con, $sql );
	$productname = $resultrows [0] [0];
	return $productname;
}
function getPartnerPwdHash($con, $partnerid) {
	$sql = "select password from " . DBINFO::$COMMONDBNAME . ".partnerdetails where loginid ='$partnerid'";
	$resultrows = getResultArray ( $con, $sql );
	$pwdhash = $resultrows [0] [0];
	return $pwdhash;
}
function getPartnerID($con, $partnerid) {
	$sql = "select table_id from " . DBINFO::$COMMONDBNAME . ".partnerdetails where loginid ='$partnerid'";
	$resultrows = getResultArray ( $con, $sql );
	$pid = $resultrows [0] [0];
	return $pid;
}
function getappSaasConfigInfo($con, $productid) {
	$sql = "select appName,Description,title from " . DBINFO::$APPDBNAME . ".saasconfig where productid ='$productid'";
	$resultrows = getResultArray ( $con, $sql );
	return $resultrows;
}
function getProductIdFromProductName($con, $productname) {
	$sql = "select product_id from " . DBINFO::$APPDBNAME . ".productdetails where productname ='$productname'";
	$resultrows = getResultArray ( $con, $sql );
	$productid = $resultrows [0] [0];
	return $productid;
}
function getHostNameByIp() {
	$WEBSITE_URL = $_SERVER ['HTTP_HOST'];
	return $WEBSITE_URL;
}
function sendCustomerActivationMail($con, $userid, $appid, $productname, $packagename) {
	$productid = getProductId ();
	$editionid = getEditionIndex ();
	$sql = "SELECT name FROM " . DBINFO::$APPDBNAME . ".editiontable where editionindex = '$editionid'";
	$dbrows = getResultArray ( $con, $sql );
	$editionname = $dbrows [0] [0];
	$proedition = $productid . '_' . $editionid;
	$sql = "SELECT city,noofuser FROM " . DBINFO::$APPDBNAME . "." . $proedition . "_orginfo  where userid = '$userid'";
	$dbrows = getResultArray ( $con, $sql );
	$location = $dbrows [0] [0];
	$customerrange = $dbrows [0] [1];
	$dbname = DBINFO::$APPDBNAME . $appid;
	$sql = "select Organization_Name,Email_id,Phone_No_1,Phone_No_2,Name,createdon from " . $dbname . ".table_21_frm";
	$orgrows = getResultArray ( $con, $sql );
	$company = $orgrows [0] [0];
	$mailid = $orgrows [0] [1];
	$phone = $orgrows [0] [3];
	$username = $orgrows [0] [4];
	$regsdate = $orgrows [0] [5];
	$emailids [] = APPINFO::$SALES_MAIL_ID;
	if ($packagename != "") {
		$playstorelink = "";
		$playstore = "";
		$download = "";
	} else {
		$playstorelink = APPINFO::$PLAYSTORE_LINK;
		$playstore = 'You can download Cratio Field Force Management App from Google Play Store ';
		$download = '(Download) & ';
	}
	$subject = "Account Activation Alert!";
	
	$temp = "<span style= \"font-size:15px;font-family:Arial;color:#0000ff;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline; \"></span><br>
<span style= \"font-size:15px;font-family:'Circular',Helvetica,Open Sans,Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline; \"></span><br>
<span style= \"font-size:15px;font-family:'Circular',Helvetica,Open Sans,Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline; \"> Hi Cratio Team,</span><br>
<span style= \"font-size:15px;font-family:'Circular',Helvetica,Open Sans,Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline; \"></span><br>
<span style= \"font-size:15px;font-family:'Circular',Helvetica,Open Sans,Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline; \"> New Account has been activated to our cratio CRM application.</span><br><br>

<span style= \"font-size:15px;font-family:'Circular',Helvetica,Open Sans,Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline; \">User details are :<br></span>
<div class=\"datagrid\" style=\"margin-top:14px;font: normal 12px/150% Arial, Helvetica, sans-serif;background: #fff; overflow: hidden;border: 2px solid rgba(225, 238, 244, 0.37); -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;\">
    <table style=\"width:100%;\">
        <tbody style=\"border-collapse: collapse;text-align: left; width: 100%;\">
            <tr>
                <td style=\"border-left: none;padding: 8px 15px;color: #00496B;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">Name</td>
                <td style=\"padding: 8px 15px;color: #00496B;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">$username</td>
            </tr>
            <tr class=\"alt\">
                <td style=\"background: rgba(225, 238, 244, 0.37);color: #00496B;padding: 8px 15px;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">Company</td>
                <td style=\"background: rgba(225, 238, 244, 0.37);color: #00496B;padding: 8px 15px;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">$company</td>
            </tr>
            <tr>
                <td style=\"padding: 8px 15px;color: #00496B;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">E-Mail</td>
                <td style=\"padding: 8px 15px;color: #00496B;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">$mailid</td>
            </tr>
            <tr class=\"alt\">
                <td style=\"background: rgba(225, 238, 244, 0.37);color: #00496B;padding: 8px 15px;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">Phone</td>
                <td style=\"background: rgba(225, 238, 244, 0.37);color: #00496B;padding: 8px 15px;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">$phone</td>
            </tr>
            <tr>
                <td style=\"padding: 8px 15px;color: #00496B;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">Appid</td>
                <td style=\"padding: 8px 15px;color: #00496B;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">$appid</td>
            </tr>
            <tr class=\"alt\">
                <td style=\"background: rgba(225, 238, 244, 0.37);color: #00496B;padding: 8px 15px;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">SignUp Date</td>
                <td style=\"background: rgba(225, 238, 244, 0.37);color: #00496B;padding: 8px 15px;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">$regsdate</td>
            </tr>
            <tr class=\"alt\">
                <td style=\"padding: 8px 15px;color: #00496B;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">Location</td>
                <td style=\"padding: 8px 15px;color: #00496B;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">$location</td>
            </tr>
            <tr >
                <td style=\"border-bottom: none;background: rgba(225, 238, 244, 0.37);color: #00496B;padding: 8px 15px;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">Edition</td>
                <td style=\"background: rgba(225, 238, 244, 0.37);color: #00496B;padding: 8px 15px;border-left: 3px solid rgba(225, 238, 244, 0.37);font-size: 15px;font-weight: normal; \">$editionname</td>
            </tr>
        </tbody>
    </table>
</div>";
	
	$reason = smtpmail ( $emailids, $subject, $temp, "", "", false, $appid, "" );
	if (strpos ( $reason, 'Error' ) === 0) {
		$status = false;
	} else {
		$status = true;
	}
	if ($status) {
		$errormsg = ServerError::$GENERAL_SUCCESS_MSG;
		debug ( "Mail sent successfully" );
		// sendSignupIntroMail($emailids);
		$errormsg = "send";
	} else {
		debug ( "Fail to send a mail" );
		$errormsg = "failed";
	}
	$content = "<html>
	<head>
		<title></title>
	</head>
	<body>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			&nbsp;</p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f746-609f-3f03-9beb63aeed1b' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Hi $username,</span></b></p>
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f746-609f-3f03-9beb63aeed1b' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>I am Suresh Shamalan your account manager, your account is active now and you can use it right away.</span></b></p>
		<br />
		<span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>I shall provide you personalized online demo &amp; training at your convenient time to get started quickly. </span><br class='kix-line-break' />
			<br class='kix-line-break' />
			<span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Feel free to schedule an one to one online session by replying this mail, looking forward to serve you.</span><br class='kix-line-break' />
			<br class='kix-line-break' />
			<span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Thank You,</span><br class='kix-line-break' />
			<span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Suresh Shamalan,</span><br class='kix-line-break' />
			<span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Account Manager.</span></b></p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f746-609f-3f03-9beb63aeed1b' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>+91-8939148148</span></b></p>
			</body>
</html>
    ";
	$emailids = array ();
	$emailids [] = $userid;
	$reason = smtpmail ( $emailids, "Cratio CRM Account Activation Confirmation", $content, "Cratio CRM", "", false, "", "sales@cratio.com" );
}
function sendSignupErrorMail($name, $company, $mobileno, $city, $error) {
	$emailids [] = "support@cratio.com";
	$content = "<html>
	<head>
		<title></title>
	</head>
	<body>
		<p>
			Hi Support</p>
		<p>
			Error showing when users signup.</p>
		<p>
			User Detail:</p>
		<p>
			Name : $name</p>
		<p>
			Company : $company</p>
		<p>
			Phone : $mobileno</p>
		<p>
			City : $city</p>
		<p>
			Error Detail:</p>
		<p>
			$error</p>
	</body>
</html>";
	smtpmail ( $emailids, "Error Showing When User Signup", $content, "", "", false, "", "" );
}
function processRegistration($con, $obj, $appid, $productname, $editionindex, $nextid) {
	$regstatus = true;
	startTransaction ( $con );
	try {
		$companyname = $obj->{'companyname'};
		$companyname = mysql_escape_string ( $companyname );
		$emailid = $obj->{'useremail'};
		$userid = $obj->{'username'};
		$mobilenum = $obj->{'mobilenum'};
		$phonenum = $obj->{'phonenum'};
		$state = $obj->{'state'};
		$industry = $obj->{'industry'};
		$noofuser = $obj->{'customerrange'};
		// $noofuser = $obj->{'noofuser'};
		// $address = $obj->{'address'};
		$productid = $obj->{'productid'};
		$city = $obj->{'city'};
		$isOpenid = $obj->{'isOpenid'};
		$currenttime = date ( "Y-m-d H:i:s" );
		$currentdate = date ( "Y-m-d" );
		$userdesignation = $obj->{'signupdesignation'};
		$isinstancesignup = $obj->{'isinstancesignup'};
		$device = $obj->{'device'};
		$acctype = $obj->{'acctype'};
		$handleby = $obj->{'handleby'};
		$appstatus = 1;
		$partnerid = "";
		$status = "";
		$packagename = $obj->{'packagename'};
		if ($isinstancesignup == "1") {
			$partnername = $obj->{'partnerid'};
			$partnerid = getPartnerID ( $con, $partnername );
			$appstatus = 0;
		} else if ($device == "mobile") {
			$appstatus = 2;
			$status = "Active";
		}
		$locationdetails = getGEOLocationByIP ();
		$prodext = getSaasProductExt ();
		$productid = getProductId ();
		$editionindex = getEditionIndex ();
		$sql = "insert into " . DBINFO::$APPDBNAME . '.' . $productid . "_editionreg values('$appid', '$editionindex', '$emailid' )";
		$result = execSQL ( $con, $sql );
		$sql = "insert into " . DBINFO::$APPDBNAME . '.' . $prodext . "uservsapptable values('$emailid','$emailid','$appid','$currenttime','00-00-00 00:00:00','00:00:00')";
		$result = execSQL ( $con, $sql );
		$sql = "insert into " . DBINFO::$APPDBNAME . '.' . $prodext . "orginfo values ('$appid','$emailid','$companyname','$emailid','$mobilenum','$industry','$noofuser','$phonenum','$state','$locationdetails','$appstatus','$isOpenid','$currenttime')";
		$result = execSQL ( $con, $sql );
		$appidtable = DBINFO::$APPDBNAME . "." . $prodext . "freeappidtable";
		$apparr = explode ( "_", $appid );
		$id = $apparr [2];
		$sql = "delete from $appidtable where appid = '$id'";
		$result = execSQL ( $con, $sql );
		
		if ($editionindex == '') {
			$sql = "SELECT featureset,editionindex FROM " . DBINFO::$APPDBNAME . ".editiontable where isdefault = '1'";
			$dbrows = getResultArray ( $con, $sql );
			$featureset = $dbrows [0] [0];
			$editionindex = $dbrows [0] [1];
		} else {
			$sql = "SELECT featureset,editionindex FROM " . DBINFO::$APPDBNAME . ".editiontable where editionindex = '$editionindex'";
			$dbrows = getResultArray ( $con, $sql );
			$featureset = $dbrows [0] [0];
			$editionindex = $dbrows [0] [1];
		}
		$sql = "select * FROM " . DBINFO::$APPDBNAME . ".editionvaluetable where editionindex = '$editionindex'";
		$dbrows = getResultArray ( $con, $sql );
		for($ei = 0; $ei < sizeof ( $dbrows ); $ei ++) {
			$sql = 'insert into ' . DBINFO::$APPDBNAME . '.customfeaturetable(appid,featureindex,value) values(' . '\'' . $appid . '\'' . ',' . $dbrows [$ei] [1] . ',' . '\'' . $dbrows [$ei] [2] . '\'' . ');';
			$result = execSQL ( $con, $sql );
		}
		$sql = "SELECT value FROM " . DBINFO::$APPDBNAME . ".editionvaluetable where editionindex = $editionindex and featureindex= " . LICENSE::$NOOFUSERS;
		$dbrows = getResultArray ( $con, $sql );
		$noofuser = trim($dbrows [0] [0]);
		$sql = "SELECT value FROM " . DBINFO::$APPDBNAME . ".editionvaluetable where editionindex = $editionindex and featureindex= " . LICENSE::$TOTALRECORDCOUNT;
		$dbrows = getResultArray ( $con, $sql );
		// $totalrecordcount = $dbrows[0][0];
		$sql = "SELECT value FROM " . DBINFO::$APPDBNAME . ".editionvaluetable where editionindex = $editionindex and featureindex= " . LICENSE::$TOTAL_EMAIL_COUNT;
		$dbrows = getResultArray ( $con, $sql );
		$totalemailcount = trim($dbrows [0] [0]);
		$sql = "SELECT value FROM " . DBINFO::$APPDBNAME . ".editionvaluetable where editionindex = $editionindex and featureindex= " . LICENSE::$TOTAL_SMS_COUNT;
		$dbrows = getResultArray ( $con, $sql );
		$totalsmscount = trim($dbrows [0] [0]);
		$totalrecordcount = 0;
		$sql = "SELECT value FROM " . DBINFO::$APPDBNAME . ".editionvaluetable where editionindex = $editionindex and featureindex= " . LICENSE::$TOTALSTORAGESIZE;
		$dbrows = getResultArray ( $con, $sql );
		$totalstorage = trim($dbrows [0] [0]);
		$sql = "SELECT value FROM " . DBINFO::$APPDBNAME . ".editionvaluetable where editionindex = $editionindex and featureindex= " . LICENSE::$TOTAL_ATTACHMENT_SIZE;
		$dbrows = getResultArray ( $con, $sql );
		$attachementstorage = trim($dbrows [0] [0]);
		$sql = "SELECT value FROM " . DBINFO::$APPDBNAME . ".editionvaluetable where editionindex = $editionindex and featureindex= " . LICENSE::$DURATIONOFDAYS;
		$dbrows = getResultArray ( $con, $sql );
		if ($featureset != "") {
			$sql = "insert into " . DBINFO::$APPDBNAME . ".appeditiontable values ('$appid',$editionindex,$featureset)";
			$result = execSQL ( $con, $sql );
			insertLicenseHistory ( $con, $appid, $editionindex, LICENSE::$DURATIONOFDAYS, "1", 0, 0 );
		}
		$licensed_days = trim($dbrows [0] [0]);
		if ($licensed_days == "UL") {
			$licensed_days = COMMONCONSTANTS::$UNLIMITED_DAYS;
		}
		$license_end_Date = date ( "Y-m-d", strtotime ( date ( "Y-m-d", strtotime ( $currentdate ) ) . " +" . $licensed_days . " day" ) );
		
		$usertableid = $nextid;
		$pwd = $obj->{'password'};
		$hash = preparePasswordHash ( $pwd );
		$password = $obj->{'password'};
		$hash = preparePasswordHash ( $password );
		$isbuilderapp = APPINFO::$IS_BUILDER_APP;
		$productname = getProductNameFromProductId ( $con, $productid );
		$htmlfile = getProductHtmlPageName ( $con, $productid, $productname );
		$saasconfigarr = getappSaasConfigInfo ( $con, $productid );
		$appname = $saasconfigarr [0] [0];
		$appdesc = $saasconfigarr [0] [1];
		$apptitle = $saasconfigarr [0] [2];
		$appstatus = 'InActive';
		if ($isinstancesignup == "1") {
			$appstatus = 'Active';
		}
		$account_type = $acctype;
		$builderid_url_str = "";
		if ($isbuilderapp) {
			$usertableid = $nextid;
			$sql = "insert into table_6_frm (table_6_id,Name,password,Emailid,MobileNo,Account_Status,isadmin,createdon,updatedon,userid) values ('$usertableid','$userid','$hash','$emailid','$mobilenum','Active','" . CHECKBOXVALUES::$ENABLED . "','$currenttime','$currenttime','$usertableid');";
			$result = execSQL ( $con, $sql );
			$dbname = $appid . "_" . DBINFO::$APPDBNAME;
			$producttype = "builder";
			$nextuserid = getNextIdValue ( $con, "$dbname.table_6_frm", "table_6_id" );
			$sql = "insert into $dbname.table_6_frm (table_6_id,Name,password,Emailid,MobileNo,Account_Status,isadmin,createdon,updatedon,userid) values ('$nextuserid','$userid','$hash','$emailid','$mobilenum','Active','" . CHECKBOXVALUES::$ENABLED . "','$currenttime','$currenttime','$usertableid');";
			$result = execSQL ( $con, $sql );
			$builderid_url_str = "&BUILDERID=" . $appid;
		} else {
			$secf = "";
			$secv = "";
			$secf = ",table_11_0_table_11_id,Answer";
			$secv = ",'0','6a36779bd399982d4bd81919baee9338671f869d07aa1a580fbd5e60da77136c9c77d00cb180c5ef076bb33de69615bf396109430cec1f6fceb12229bca7bd1570d9d91a'";
			$sql = "use " . DBINFO::$APPDBNAME . $appid;
			$result = execSQL ( $con, $sql );
			// $usertableid = getNextIdValue($con, "table_6_frm", "table_6_id");
			// updateFormMaxId($con, "table_6_frm", $usertableid);
			$usertableid = getFormMaxId ( $con, 'table_6_frm' );
			$sql = "insert into table_6_frm (table_6_id,Name,loginid,password,table_4_0_table_4_id,table_2_0_table_2_id,Emailid,MobileNo,Account_Status,Is_Admin,Address,createdon,table_6_0_table_6_id,updatedon,table_6_1_table_6_id,viewedon,table_6_2_table_6_id,table_39_0_table_39_id $secf,Show_All_Reportee_Data,Show_Reportee_Data,Default_Currency,Time_Zone,Login_Allowed,Auto_Tracking) values ('$usertableid','$userid','$userid','$hash','1','1','$emailid','$mobilenum','Active','" . CHECKBOXVALUES::$ENABLED . "','$address','$currenttime','0','$currenttime','0','0000-00-00 00:00:00', '0','0' $secv,'Yes','Yes','','(GMT +05:30)-Asia/Kolkata','All','On');";
			$result = execSQL ( $con, $sql );
			insertSyncQueryDetails ( $con, "table_6_frm", $usertableid, DB_ACTION::$INSERT, $sql );
			$sql = "select Emailid from table_6_frm where Emailid = 'support@cratio.com'";
		    $remoteuserexist = getResultArray ( $con, $sql );
			if(sizeof($remoteuserexist) == 0){
			$remusertableid = getFormMaxId ( $con, 'table_6_frm' );
			$remoteusername="cratiosupport";
			$remoteuseremail="support@cratio.com";
			$remoteuserpwd=preparePasswordHash ("cratiosupport123");
			$remoteusermobile="9790704954";
			$remoteuseraddress="#52,New Colony 1st Main Road,Chrompet-600044";	
			$sql = "insert into table_6_frm (table_6_id,Name,loginid,password,table_4_0_table_4_id,table_2_0_table_2_id,Emailid,MobileNo,Account_Status,Is_Admin,Address,createdon,table_6_0_table_6_id,updatedon,table_6_1_table_6_id,viewedon,table_6_2_table_6_id,table_39_0_table_39_id $secf,Show_All_Reportee_Data,Show_Reportee_Data,Default_Currency,Time_Zone,Login_Allowed,Auto_Tracking) values ('$remusertableid','$remoteusername','$remoteusername','$remoteuserpwd','1','1','$remoteuseremail','$remoteusermobile','Inactive','" . CHECKBOXVALUES::$ENABLED . "','$remoteuseraddress','$currenttime','0','$currenttime','0','0000-00-00 00:00:00', '0','0' $secv,'Yes','Yes','','(GMT +05:30)-Asia/Kolkata','All','On');";
			$result = execSQL ( $con, $sql );
			insertSyncQueryDetails ( $con, "table_6_frm", $remusertableid, DB_ACTION::$INSERT, $sql );	
			}			
			$ismobileclient = "Yes";
			$emailstatus = "Yes";
			$smsstatus = "Yes";
			// $sql = "select Email_Status,SMS_Status,Is_Mobile_Client from table_21_frm ";
			// $orgrows = getResultArray($con, $sql);
			// if (sizeof($orgrows) != 0) {
			// $emailstatus = $orgrows[0][0];
			// $smsstatus = $orgrows[0][1];
			// $ismobileclient = $orgrows[0][2];
			// }
			// if ($emailstatus == "") {
			// $emailstatus = "No";
			// }if ($smsstatus == "") {
			// $smsstatus = "No";
			// }
			$sql = "delete from table_21_frm";
			$result = execSQL ( $con, $sql );
			$sql = "delete from licenseinfo";
			$result = execSQL ( $con, $sql );
			$updateduserid=$usertableid;
			if ($isinstancesignup == "1") {
			$updateduserid="";
			}
			$sql = "insert into table_21_frm values('0','$companyname','','$address','$emailid','$phonenum','$mobilenum','','','Financial Year','INR,Rs.','$emailstatus','$smsstatus','dd-MM-yyyy','(GMT +05:30)-Asia/Kolkata','0','Basic','$ismobileclient','$appid','0','$companyname','0','$currenttime','$userid','$userdesignation','','','','','','','Yes','No','06:00:00','$emailid','On','Yes','15 Minutes','$updateduserid','','','');";
			$result = execSQL ( $con, $sql );
			$infotableid = getNextIdValue ( $con, "licenseinfo", "id" );
			$license_start_Date = date ( "Y-m-d" );
			$numberofuser = "UL";
			$remaininguser = "UL";
			$noofuser=trim($noofuser);			
			if ($noofuser != "UL") {
				$numberofuser = $noofuser;
				$remaininguser = $noofuser - 1;
			}			
			$sql = "insert into licenseinfo values('$infotableid','$numberofuser','$remaininguser','1','$totalrecordcount','0','0','$license_start_Date','$license_end_Date','$licensed_days','$totalemailcount','0','$totalsmscount','0');";
			$result = execSQL ( $con, $sql );
			$sql = "update filehistory set createdtime = '$currenttime', status = 'New', `size(MB)` = '0', downloadedtime = '',DS_status = ''";
			$result = execSQL ( $con, $sql );
			$resultarr = getApplicationversionfromDB ( $con, $appid );
			if (sizeof ( $resultarr ) > 0) {
				$majorversion = $resultarr [0] [0];
				$minorversion = $resultarr [0] [1];
			} else {
				$majorversion = VERSION::$MAJOR;
				$minorversion = VERSION::$MINOR;
			}
			$account_type = $acctype;
			$htmlfile = getProductHtmlPageName ( $con, $productid, $productname );
			$sql = "delete from application";
			$result = execSQL ( $con, $sql );
			$sql = "insert into application (createdby,f1,f2,f3,f4,f5,f6,f7,f8,f9,f10,f11,f12,f13,f14,updatedby) values ('$emailid','$appname','$appdesc','$apptitle','$htmlfile','$majorversion','$minorversion','$status','','','$appstatus','','','$productid','$account_type','$emailid') ";
			$result = execSQL ( $con, $sql );
		}
		
		$secf = "";
		$secv = "";
		generateSaasMetrictable ( $con, $appid );
		if ($isOpenid) {
			$secf = ",table_11_0_table_11_id,Answer";
			$secv = ",'2','6b940730ccb8afe3a84ae67d052209eea7a479cc28f1b7b3adc1306f6f53210269d85d6c68e96b175116c2e98f63e01d6e8f06254e06261911dbe71d665023ae252c1b72'";
		}
		$sql = "select Emailid from table_6_frm where (Emailid != '' or Emailid is not null) and Name != 'sadmin' and Emailid != 'support@cratio.com' and Emailid != 'remotesupport@cratio.com'";
		$dbrows = getResultArray ( $con, $sql );
		for($i = 0; $i < sizeof ( $dbrows ); $i ++) {
			$useremailId = $dbrows [$i] [0];
			if ($useremailId != '') {
				$sql = 'select * from ' . DBINFO::$APPDBNAME . '.' . $prodext . 'uservsapptable where saasuserid = \'' . $useremailId . '\';';
				$res = getResultArray ( $con, $sql );
				if (sizeof ( $res ) == 0) {
					$sql = 'insert into   ' . DBINFO::$APPDBNAME . '.' . $prodext . 'uservsapptable values ( ' . '\'' . $useremailId . '\'' . ' ,' . '\'' . $useremailId . '\'' . ' , ' . '\'' . $appid . '\'' . ',' . '\'' . $currenttime . '\'' . ',' . '\'' . '' . '\'' . ',' . '\'' . '' . '\'' . ' );';
					$result = execSQL ( $con, $sql );
					$sql = "insert into " . DBINFO::$APPDBNAME . '.' . $productid . "_editionreg values('$appid', '$editionindex', '$useremailId' )";
					$result = execSQL ( $con, $sql );
				}
			}
		}
		$dbversion = "";
		if ($majorversion != "") {
			$dbversion = $majorversion . "." . $minorversion;
		}
		$apptype = '';
		if ($isbuilderapp) {
			$apptype = 'builder';
		}
		$sql = "select table_id from " . DBINFO::$APPDBNAME . ".emailconfig where isdefault=1";
		$res = getResultArray ( $con, $sql );
		$emailserver = $res [0] [0];
		$sql = "select table_id from " . DBINFO::$APPDBNAME . ".smsconfig where isdefault=1";
		$res = getResultArray ( $con, $sql );
		$smsserver = $res [0] [0];
		$appdetails->{'emailserver'} = $emailserver;
		$appdetails->{'smsserver'} = $smsserver;
		$appdetails->{'appid'} = $appid;
		$appdetails->{'apptype'} = $apptype;
		$appdetails->{'dbversion'} = $dbversion;
		$appdetails->{'productid'} = $productid;
		$appdetails->{'accounttype'} = $account_type;
		$appdetails->{'createdby'} = $emailid;
		$appdetails->{'htmlfile'} = $htmlfile;
		$appdetails->{'appname'} = $appname;
		$appdetails->{'appdesc'} = $appdesc;
		$appdetails->{'apptitle'} = $apptitle;
		$appdetails->{'appstatus'} = $appstatus;
		$appdetails->{'partnerid'} = $partnerid;
		$appdetails->{'handleby'} = $handleby;
		$appdetails->{'orgname'}=$companyname;
		insertApplicationDetails ( $con, $appdetails );
		$url = curPageURL ();
		$url = $url . "?DIGEST=" . $emailid;
		$url = $url . "&PASS=" . $password;
		$url = $url . "&APP=" . $appid;
		$url = $url . "&PID=" . $productid;
		$url = $url . "&DATE=" . $currentdate;
		$url = $url . "&EDITIONINDEX=" . $editionindex;
		$url = $url . $builderid_url_str;
		$url = $url . "&PACKAGE=" . $packagename;
		$pwd = $obj->{'pwd'};
		$emailids = array ();
		$emailids [] = $emailid;
		$productname = strtoupper ( $productname );
		if ($productname == "FSM") {
			$subject = 'Welcome to Cratio CRM Software';
		} else {
			$subject = 'Welcome to Cratio CRM Software';
		}
		$browser = $_SERVER ['HTTP_USER_AGENT'];
		// $imgurl = getLogoUrl();
		$passstr = "<b>Password     :</b> $password";
		if ($isOpenid) {
			$passstr = "";
		}
		$loginfilename = "/login.php";
		$filename = strtolower ( $productname ) . $loginfilename;
		$loginurl = getHostNameByIp () . '/' . $filename;
		$messsage = getSignupTemplate ( $con, $userid, $emailid, $passstr, $currentdate, $license_end_Date, $loginurl, $url, $productid, $packagename );
		debug ( "REGISTRATION MAIL MSG :  $messsage" );
		if ($isinstancesignup == "0" && $device != "mobile") {
			$reason = smtpmail ( $emailids, $subject, $messsage, "Cratio CRM", "", false, "", "sales@cratio.com" );
			if (strpos ( $reason, 'Error' ) === 0) {
				$status = false;
			} else {
				$status = true;
			}
			if ($status) {
				$errormsg = ServerError::$GENERAL_SUCCESS_MSG;
				debug ( "Mail sent successfully" );
				// sendSignupIntroMail($emailids);
				$errormsg = "send";
			} else {
				debug ( "Fail to send a mail" );
				$errormsg = "failed";
			}
		}
        updateInboundEmailConfig($con,$emailid,$appid);
		//setSaasMobileDB ( $con, $obj, $appid, $productid, $editionindex, $usertableid );
		
	//	setSaasMobileDB ( $con, $obj, $appid, $productid, $editionindex, $remusertableid );
		// $content = "Dear $userid, Thanks for choosing cratiocrm.com. Your Username $emailid; Password $password Contact: support@cratio.com, 9092198198 for any help";
		// $content = urlencode($content);
		// $url = "http://www.smsapp.in/api/sms.php?uid=646163616d&pin=4f55dd879fb32&sender=APPSMS&route=1&mobile=$mobilenum&message=$content";
		// debug("The URL is $url");
		// $handle = curl_init($url);
		// curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
		// $response = curl_exec($handle);
		commitTransaction ( $con );
	} catch ( Exception $e ) {
		debug ( "EXCEPTION : " . $e->getMessage () );
		$errormsg = $e->getMessage ();
		if (strpos ( $errormsg, ": 1062 " ) > 0) {
			if (strpos ( $errormsg, "'" . $emailid . "'" ) > 0) {
				$errormsg = "Emailid Already Exists!";
			} else if (strpos ( $errormsg, "'" . $userid . "'" ) > 0) {
				$errormsg = "UserName Already Exists!";
			} else {
				$errormsg = "Duplicate Entry!";
			}
		}
		rollbackTransaction ( $con );
		$regstatus = false;
	}
	if (($errormsg == "") || (strpos ( $errormsg, 'Emailid is Already' ) !== false) || (strpos ( $errormsg, 'Failed to send the mail' ) !== false) || (strpos ( $errormsg, 'Company Name has' ) !== false) || (strpos ( $errormsg, 'UserName Already Exists!' ) !== false) || (strpos ( $errormsg, 'send' ) !== false)) {
	} else {
		sendSignupErrorMail ( $userid, $companyname, $mobilenum, $city, $errormsg );
	}
	setError ( $errormsg );
	if (SAASDETAILS::$NEEDSIGNUPMAILTODAP && ($account_type == "Prospect" || $account_type == "Customer") && $regstatus) {
		sendSignupCopyToDap ( $appid, $emailid, $companyname, $productname );
	}
	return $regstatus;
}
function getProductHtmlPageName($con, $pid, $productname) {
	// $sql = "select loginpage from " . DBINFO::$APPDBNAME . ".saasconfig where productid = '$pid'";
	// $res = getResultArray($con, $sql);
	// if ($res[0][0] != '')
	// return $res[0][0];
	// else
	return strtolower ( $productname ) . '.html';
}
function getImageUrl($image) {
	$imgurl = 'http';
	if ($_SERVER ['HTTPS'] == 'on') {
		$imgurl .= 's';
	}
	$imgurl .= '://';
	if ($_SERVER ['SERVER_PORT'] != '80') {
		$imgurl .= $_SERVER ['SERVER_NAME'] . ':' . $_SERVER ['SERVER_PORT'] . '/Content/images/' . $image;
	} else {
		$imgurl .= $_SERVER ['SERVER_NAME'] . '/Content/images/' . $image;
	}
	return $imgurl;
}
function getServerUrl() {
	$url = 'http';
	if ($_SERVER ['HTTPS'] == 'on') {
		$url .= 's';
	}
	$url .= '://';
	if ($_SERVER ['SERVER_PORT'] != '80') {
		$url .= $_SERVER ['SERVER_NAME'] . ':' . $_SERVER ['SERVER_PORT'];
	} else {
		$url .= $_SERVER ['SERVER_NAME'];
	}
	return $url;
}
function generateRandomPassword() {
	$pwd = '';
	for($i = 0; $i < 6; $i ++) {
		$d = rand ( 1, 30 ) % 2;
		$pwd .= $d ? chr ( rand ( 65, 90 ) ) : chr ( rand ( 48, 57 ) );
	}
	return $pwd;
}
function sendSignupIntroMail($emailids) {
	$subject = "Welcome to Cratio";
	$message = getIntroMailTemp ();
	// $emailids[] = "support@cratio.com";
	$reason = smtpmail ( $emailids, $subject, $message, $loginuser, "", false, "", "" );
	if (strpos ( $reason, 'Error' ) === 0) {
		$status = false;
	} else {
		$status = true;
	}
	if ($status) {
		$errormsg = ServerError::$GENERAL_SUCCESS_MSG;
		debug ( "Mail sent successfully" );
	} else {
		debug ( "Fail to send a mail" );
	}
}
function insertApplicationDetails($con, $appdetails) {
	$appid = $appdetails->{'appid'};
	$orgname = $appdetails->{'orgname'};
	$apptype = $appdetails->{'apptype'};
	$dbversion = $appdetails->{'dbversion'};
	$productid = $appdetails->{'productid'};
	$account_type = $appdetails->{'accounttype'};
	if (isset ( $appdetails->{'createdby'} )) {
		$emailid = $appdetails->{'createdby'};
	} else {
		$emailid = $appdetails->{'updatedby'};
	}
	$htmlfile = $appdetails->{'htmlfile'};
	$appname = $appdetails->{'appname'};
	$appdesc = $appdetails->{'appdesc'};
	$apptitle = $appdetails->{'apptitle'};
	$appstatus = $appdetails->{'appstatus'};
	$emailserver = $appdetails->{'emailserver'};
	$smsserver = $appdetails->{'smsserver'};
	$partnerid = $appdetails->{'partnerid'};
	$handleby=$appdetails->{'handleby'};
	$f14 = '0';
	$f15 = '0';
	$f16 = '0';
	$sql = 'select * from ' . DBINFO::$APPDBNAME . '.applicationlist where appid = ' . '\'' . $appid . '\'';
	$resultArr = getResultArray ( $con, $sql );
	$username = getUserName ();
	$currentdatetime = date ( 'Y-m-d H:i:s' );
	$isallowsadminlogin = 0;
	$issaveinaws = 1;
	if ($productid == "") {
		$isallowsadminlogin = 1;
	}
	$orgname=mysql_escape_string($orgname);
	if (sizeof ( $resultArr ) == 0) {
		$sql = "insert into " . DBINFO::$APPDBNAME . ".applicationlist(appid,f14,f15,f16,f17,f18,f19,f20,f21,f1,f2,f3,f4,f5,f6,f7,f8,f9,f10,f11,f12,f13,f22,f23,f24,f25,f26,f27,f28,f29,createdtimeat,createdby) values('$appid','$f14','$f15','$f16','1','1','1','1','0','$apptype','$appname','$appdesc','$apptitle','$htmlfile','$dbversion','$appstatus','$orgname','$productid','$account_type','$emailserver','$smsserver','$partnerid','0','0','$isallowsadminlogin','$issaveinaws','0','0','0','$handleby','$currentdatetime','$emailid')";
	} else {
		$sql = 'update ' . DBINFO::$APPDBNAME . '.applicationlist set updatedtimeat = ' . '\'' . $currentdatetime . '\'' . ', updatedby = ' . '\'' . $emailid . '\'' . ', f2 = ' . '\'' . $appname . '\'' . ', f3 = ' . '\'' . $appdesc . '\'' . ', f4 = ' . '\'' . $apptitle . '\'' . ', f5 = ' . '\'' . $htmlfile . '\'' . ', f6 = ' . '\'' . $dbversion . '\'' . ', f7 = ' . '\'' . $appstatus . '\''. ', f8 = ' . '\'' . $orgname . '\'' . ', f10= ' . '\'' . $account_type . '\'' . ', f13= ' . '\'' . $partnerid . '\'' . ' where appid = ' . '\'' . $appid . '\'';
	}
	$result = execSQL ( $con, $sql );
}
function getCurrentLicenseEdition($con) {
	$appid = getAppId ();
	$sql = "select edi.name from  " . DBINFO::$APPDBNAME . ".appeditiontable aedi," . DBINFO::$APPDBNAME . ".editiontable edi where aedi.appid = '$appid' and edi.editionindex = aedi.editionindex";
	$result = getResultArray ( $con, $sql );
	return $result [0] [0];
}
function getHostedLaunchPage($con) {
	$launchPage = "";
	if (isset ( $GLOBALS ["f4"] )) {
		$launchPage = $GLOBALS ["f4"];
	} else {
		$sql = "select f4 from application";
		$result = getResultArray ( $con, $sql );
		$GLOBALS ["f4"] = $result [0] [0];
		$launchPage = $GLOBALS ["f4"];
	}
	
	return $launchPage;
}
function getSaasInfo($con, $obj) {
	$entity = $obj->{'ENTITY'};
	debug ( 'Entity is ' . $entity );
	$userid = $obj->{'useremail'};
	if ($userid == "") {
		$userid = $obj->{'username'};
	}
	$prodext = getSaasProductExt ();
	$sql = 'select * from  ' . DBINFO::$APPDBNAME . '.' . $prodext . 'uservsapptable where saasuserid=' . '\'' . $userid . '\'' . ';';
	$dbrows = getResultArray ( $con, $sql );
	if (sizeof ( $dbrows ) > 0) {
		$sql = 'select applicationstatus from  ' . DBINFO::$APPDBNAME . '.' . $prodext . 'orginfo where userid=' . '\'' . $userid . '\'' . ';';
		$resu = getResultArray ( $con, $sql );
		$accountstatus = $resu [0] [0];
		if ($accountstatus == 1) {
			return 'Not validated';
		} else if ($accountstatus == 3) {
			return 'Under Maintenence';
		} else if ($accountstatus == 4) {
			return 'Inactive';
		}
		return new SaasInfo ( $dbrows [0] );
	} else {
		return NULL;
	}
}
function getFormFieldType($con, $formname, $fieldname) {
	//$sql = 'select type from formfieldtable where name=' . '\'' . $fieldname . '\'' . ' and formname=' . '\'' . $formname . '\'';
	//$rows = getResultArray ( $con, $sql );
	$rows=getFormFieldTypeFromSession($con, $formname, $fieldname);
	$fieldtype = $rows [0] [0];
	return $fieldtype;
}
function getFormFieldDetails($con, $formname, $fieldname){
	$sql="select type,ismandatory,isunique from formfieldtable where formname='$formname' and name='$fieldname';";
	$rows = getResultArray ( $con, $sql );
	return $rows[0];
}
function getFormFieldTypeWithDefaultValue($con, $formname, $fieldname) {
	$sql = 'select type,defaultvalue from formfieldtable where name=' . '\'' . $fieldname . '\'' . ' and formname=' . '\'' . $formname . '\'';
	$rows = getResultArray ( $con, $sql );
	$response = array ();
	$response [] = $rows [0] [0];
	$response [] = $rows [0] [1];
	return $response;
}
function curPageURL() {
	$pageURL = 'http';
	$page = $_SERVER[REQUEST_URI];//'saasuseractive.php';
	if ($_SERVER ['HTTPS'] == 'on') {
		$pageURL .= 's';
	}
	$pageURL .= '://';
	if ($_SERVER ['SERVER_PORT'] != '80') {
		$pageURL .= $_SERVER ['SERVER_NAME'] . ':' . $_SERVER ['SERVER_PORT'] . $page;
	} else {
		$pageURL .= $_SERVER ['SERVER_NAME'] . $page;
	}
	return $pageURL;
}
function getBaseURL() {
	$protocol = 'http';
	if (isset ( $_SERVER ['SERVER_PORT'] ) && $_SERVER ['SERVER_PORT'] == '443') {
		$protocol = 'https';
	}
	$host = $_SERVER ['HTTP_HOST'];
	$uri = $_SERVER ['REQUEST_URI'];
	$baseUrl = $protocol . '://' . $host . dirname ( $_SERVER ['PHP_SELF'] );
	$baseUrlarr = explode ( 'dacamweb', $baseUrl );
	$baseUrl = $baseUrlarr [0];
	// if (substr($baseUrl, -2) == '/') {
	// $baseUrl = substr($baseUrl, 0, strlen($baseUrl) - 1);
	// }
	return $baseUrl;
}
function getNthinstanceForAssignedTo($con, $formname) {
	$key=$formname."_assigned_to_nthinstance";
	if(isset($GLOBALS [$key])){
	return $GLOBALS [$key];
	}else{
	$value=-1;
	$sql = 'select frt.nthinstance from formfieldtable fft
                left join formrelationtable frt on fft.formname=frt.mtable and fft.relationid= frt.relationid
                where fft.formname=' . '\'' . $formname . '\'' . ' and fft.type=' . '\'' . 'entity_group' . '\'';
	$dbrows = getResultArray ( $con, $sql );
	if (sizeof ( $dbrows ) > 0) {
		$value= $dbrows [0] [0];
	} 
	$GLOBALS [$key]=$value;
	return $value;	
	}	
}
function getNthinstanceForAssignedtoGroup($con, $formname) {
	$sql = 'select frt.nthinstance from formfieldtable fft
                left join formrelationtable frt on fft.formname=frt.mtable and fft.relationid= frt.relationid
                where fft.formname=' . '\'' . $formname . '\'' . ' and fft.type=' . '\'' . 'reference_group' . '\'';
	$dbrows = getResultArray ( $con, $sql );
	if (sizeof ( $dbrows ) > 0) {
		return $dbrows [0] [0];
	} else {
		return - 1;
	}
}
function dateDiffInDays($startdate, $enddate) {
	$diff = abs ( strtotime ( $enddate ) - strtotime ( $startdate ) );
	return $diff / (60 * 60 * 24);
}
function dateTimeDiff($data_ref) {
	$timediff = array ();
	// Get the current date
	$current_date = date ( 'Y-m-d H:i:s' );
	
	// Extract from $current_date
	$current_year = substr ( $current_date, 0, 4 );
	$current_month = substr ( $current_date, 5, 2 );
	$current_day = substr ( $current_date, 8, 2 );
	
	// Extract from $data_ref
	$ref_year = substr ( $data_ref, 0, 4 );
	$ref_month = substr ( $data_ref, 5, 2 );
	$ref_day = substr ( $data_ref, 8, 2 );
	
	// create a string yyyymmdd 20071021
	$tempMaxDate = $current_year . $current_month . $current_day;
	$tempDataRef = $ref_year . $ref_month . $ref_day;
	
	$tempDifference = $tempMaxDate - $tempDataRef;
	
	// If the difference is GT 10 days show the date
	if ($tempDifference >= 10) {
		// echo $data_ref;
	} else {
		
		// Extract $current_date H:m:ss
		$current_hour = substr ( $current_date, 11, 2 );
		$current_min = substr ( $current_date, 14, 2 );
		$current_seconds = substr ( $current_date, 17, 2 );
		
		// Extract $data_ref Date H:m:ss
		$ref_hour = substr ( $data_ref, 11, 2 );
		$ref_min = substr ( $data_ref, 14, 2 );
		$ref_seconds = substr ( $data_ref, 17, 2 );
		
		$hDf = $current_hour - $ref_hour;
		$mDf = $current_min - $ref_min;
		$sDf = $current_seconds - $ref_seconds;
		
		$timediff [] = $hDf;
		$timediff [] = $mDf;
		$timediff [] = $mDf;
	}
	return $timediff;
}
function getTotalSMSCount($con) {
	$sql = 'select Total_SMS from table_29_frm';
	$resultarr = getResultArray ( $con, $sql );
	return $resultarr [0] [0];
}
function getForcastingFormname($con) {
	$sql = ' select potentialform from forecastingtable';
	$dbrows = getResultArray ( $con, $sql );
	$potformname = '';
	if ($dbrows [0] [0] != null) {
		$potformname = $dbrows [0] [0];
	}
	return $potformname;
}
function prepareInventoryFormnameHash($con) {
	$formnameandlablename = array ();
	$sql = 'select * from inventorytables';
	$dbrows = getResultArray ( $con, $sql );
	for($i = 0; $i < sizeof ( $dbrows ); $i ++) {
		$formname = $dbrows [$i] [0];
		$lablename = $dbrows [$i] [1];
		if ($formname != '' && $lablename != '') {
			$formnameandlablename [$lablename] = $formname;
		}
	}
	return $formnameandlablename;
}
function replacespecialcharacter($string) {
	$string = str_replace ( "'", "\'", $string );
	$string = str_replace ( '"', '\"', $string );
	if (EndsWith ( $string, "\\" )) {
		$string = $string . '\\';
	}
	return $string;
}
function getChangedDateTimeFormat($dateformat, $datavalue) {
	debug ( 'Given datetimeformat----' . $dateformat );
	debug ( 'Given datetimevalue----' . $datavalue );
	$dotexplode = explode ( ".", $dateformat );
	$slashexplode = explode ( "/", $dateformat );
	$commaexplode = explode ( ",", $dateformat );
	$hifenexplode = explode ( "-", $dateformat );
	$first = "";
	$sec = "";
	$third = "";
	$symbol = "-";
	if (sizeof ( $dotexplode ) == 3) {
		$first = $dotexplode [0];
		$sec = $dotexplode [1];
		$third = $dotexplode [2];
		$symbol = ".";
	} else if (sizeof ( $slashexplode ) >= 3) {
		$first = $slashexplode [0];
		$sec = $slashexplode [1];
		$third = $slashexplode [2];
		$symbol = "/";
	} else if (sizeof ( $commaexplode ) == 3) {
		$first = $commaexplode [0];
		$sec = $commaexplode [1];
		$third = $commaexplode [2];
		$symbol = ",";
	} else if (sizeof ( $hifenexplode ) == 3) {
		$first = $hifenexplode [0];
		$sec = $hifenexplode [1];
		$third = $hifenexplode [2];
	}
	$dbdateformat = "";
	$thirdposition = explode ( " ", $third );
	$third = $thirdposition [0];
	$hourandmin = $thirdposition [1];
	$ampmstr = "";
	if (sizeof ( $thirdposition ) == 3) {
		$ampmstr = $thirdposition [2];
	}
	if ($first [0] == 'y' || $first [0] == 'Y') {
		$yearlen = strlen ( $first );
		if ($yearlen > 2) {
			$dbdateformat = $dbdateformat . "Y" . $symbol;
		} else {
			$dbdateformat = $dbdateformat . "y" . $symbol;
		}
	} else if ($first [0] == 'm' || $first [0] == 'M') {
		$dbdateformat = $dbdateformat . "m" . $symbol;
	} else if ($first [0] == 'd' || $first [0] == 'D') {
		$dbdateformat = $dbdateformat . "d" . $symbol;
	}
	if ($sec [0] == 'y' || $sec [0] == 'Y') {
		$yearlen = strlen ( $sec );
		if ($yearlen > 2) {
			$dbdateformat = $dbdateformat . "Y" . $symbol;
		} else {
			$dbdateformat = $dbdateformat . "y" . $symbol;
		}
	} else if ($sec [0] == 'm' || $sec [0] == 'M') {
		$dbdateformat = $dbdateformat . "m" . $symbol;
	} else if ($sec [0] == 'd' || $sec [0] == 'D') {
		$dbdateformat = $dbdateformat . "d" . $symbol;
	}
	if ($third [0] == 'y' || $third [0] == 'Y') {
		$yearlen = strlen ( $third );
		if ($yearlen > 2) {
			$dbdateformat = $dbdateformat . "Y" . $symbol;
		} else {
			$dbdateformat = $dbdateformat . "y" . $symbol;
		}
	} else if ($third [0] == 'm' || $third [0] == 'M') {
		$dbdateformat = $dbdateformat . "m" . $symbol;
	} else if ($third [0] == 'd' || $third [0] == 'D') {
		$dbdateformat = $dbdateformat . "d" . $symbol;
	}
	if ($ampmstr != "") {
		$dbdateformat = $dbdateformat . "g:i A";
	} else {
		$dbdateformat = $dbdateformat . "H:i:s";
	}
	
	$dbdate = date_parse_from_format ( $dbdateformat, $datavalue );
	
	$year = $dbdate ["year"];
	$month = $dbdate ["month"];
	$day = $dbdate ["day"];
	$hour = $dbdate ["hour"];
	$min = $dbdate ["minute"];
	$sec = $dbdate ["second"];
	$dbdatevalue = $year . "-" . $month . "-" . $day . " " . $hour . ":" . $min . ":" . $sec;
	debug ( 'Changed datetimevalue >>>>>>>=' . $dbdatevalue . ' for the given value is ' . $datavalue . ' given format..' . $dateformat );
	return $dbdatevalue;
}
function getChangedTimeFormat($timevalue,$timeformat) {
	debug ( 'Given timeformat----' . $timeformat );
	debug ( 'Given timevalue----' . $timevalue );
	if ($timevalue != "") {
		$date = new DateTime ( $timevalue );		
		$dbtimeformat = $date->format ( $timeformat );
	} else {
		$dbtimeformat = "";
	}
	// debug('Changed timevalue >>>>>>>=' . $dbtimeformat . ' for the given value is ' . $timevalue . ' given format..' . $timeformat);
	return $dbtimeformat."";
}
function getChangedDateFormat($dateformat, $datavalue) {
	
	//debug('Given dateformat----' . $dateformat);
	//debug('Given datevalue----' . $datavalue);
	if ($datavalue != "") {
		$date = new DateTime ( $datavalue );
		$varr = explode ( " ", $datavalue );
		//$dateformat = "d-M-y";
		//if (sizeof ( $varr ) > 1) {
			//$dateformat .= " h:i A";
		//}
		$dbdateformat = $date->format ( $dateformat );
		// $dotexplode = explode(".", $dateformat);
		// $slashexplode = explode("/", $dateformat);
		// $commaexplode = explode(",", $dateformat);
		// $hifenexplode = explode("-", $dateformat);
		// $first = "";
		// $sec = "";
		// $third = "";
		// if (sizeof($dotexplode) == 3) {
		// $first = $dotexplode[0];
		// $sec = $dotexplode[1];
		// $third = $dotexplode[2];
		// } else if (sizeof($slashexplode) == 3) {
		// $first = $slashexplode[0];
		// $sec = $slashexplode[1];
		// $third = $slashexplode[2];
		// } else if (sizeof($commaexplode) == 3) {
		// $first = $commaexplode[0];
		// $sec = $commaexplode[1];
		// $third = $commaexplode[2];
		// } else if (sizeof($hifenexplode) == 3) {
		// $first = $hifenexplode[0];
		// $sec = $hifenexplode[1];
		// $third = $hifenexplode[2];
		// }
		// $dotdatavalue = explode(".", $datavalue);
		// $slashdatavalue = explode("/", $datavalue);
		// $commadatavalue = explode(",", $datavalue);
		// $hifendatavalue = explode("-", $datavalue);
		// $datevalue1 = "";
		// $datevalue2 = "";
		// $datevalue3 = "";
		// if (sizeof($dotdatavalue) == 3) {
		// $datevalue1 = $dotdatavalue[0];
		// $datevalue2 = $dotdatavalue[1];
		// $datevalue3 = $dotdatavalue[2];
		// } else if (sizeof($slashdatavalue) == 3) {
		// $datevalue1 = $slashdatavalue[0];
		// $datevalue2 = $slashdatavalue[1];
		// $datevalue3 = $slashdatavalue[2];
		// } else if (sizeof($commadatavalue) == 3) {
		// $datevalue1 = $commadatavalue[0];
		// $datevalue2 = $commadatavalue[1];
		// $datevalue3 = $commadatavalue[2];
		// } else if (sizeof($hifendatavalue) == 3) {
		// $datevalue1 = $hifendatavalue[0];
		// $datevalue2 = $hifendatavalue[1];
		// $datevalue3 = $hifendatavalue[2];
		// }
		// $dbdate = "";
		//
		// if ($first[0] == 'y' || $first[0] == 'Y') {
		// $dbdate = $datevalue1 . "-";
		// } else if ($sec[0] == 'y' || $sec[0] == 'Y') {
		// $dbdate = $dbdate . $datevalue2 . "-";
		// } else if ($third[0] == 'y' || $third[0] == 'Y') {
		// $dbdate = $dbdate . $datevalue3 . "-";
		// }
		// if ($first[0] == 'm' || $first[0] == 'M') {
		// $dbdate = $dbdate . $datevalue1 . "-";
		// } else if ($sec[0] == 'm' || $sec[0] == 'M') {
		// $dbdate = $dbdate . $datevalue2 . "-";
		// } else if ($third[0] == 'm' || $third[0] == 'M') {
		// $dbdate = $dbdate . $datevalue3 . "-";
		// }
		// if ($first[0] == 'd' || $first[0] == 'D') {
		// $dbdate = $dbdate . $datevalue1;
		// } else if ($sec[0] == 'd' || $sec[0] == 'D') {
		// $dbdate = $dbdate . $datevalue2;
		// } else if ($third[0] == 'd' || $third[0] == 'D') {
		// $dbdate = $dbdate . $datevalue3;
		// }
		// $dbdatefor = explode('-', $dbdate);
		// $dbyearlen = sizeof($dbdate[0]);
		// $yearval = false;
		// if ($first != 'yyyy' || $first != 'YYYY') {
		// $yearval = true;
		// }
		// if ($dbyearlen <= 2 && $first != "" && !$yearval) {
		// $dbyear = '20' . $dbdatefor[0];
		// $datestr = $dbyear . "-" . $dbdatefor[1] . "-" . $dbdatefor[2];
		// } else {
		// $datestr = $dbdate;
		// }
		// $dbdateformat = date($datestr);
	} else {
		$dbdateformat = "";
	}
	// debug('Changed datevalue >>>>>>>=' . $dbdateformat . ' for the given value is ' . $datavalue . ' given format..' . $dateformat);
	return $dbdateformat."";
}
function processLicenseDowngrade($con, $obj) {
	$appid = $obj->{'APPID'};
	if ($appid == '') {
		$appid = getAppId ();
	}
	$sql = "SELECT featureset,editionindex FROM " . DBINFO::$APPDBNAME . ".editiontable where isdefault = '1'";
	$dbrows = getResultArray ( $con, $sql );
	$featureset = $dbrows [0] [0];
	$editionindex = $dbrows [0] [1];
	$sql = "select * FROM " . DBINFO::$APPDBNAME . ".editionvaluetable where editionindex = $editionindex";
	$dbrows = getResultArray ( $con, $sql );
	$sql = "delete from " . DBINFO::$APPDBNAME . ".customfeaturetable where appid='" . $appid . "'";
	$result = execSQL ( $con, $sql );
	for($ei = 0; $ei < sizeof ( $dbrows ); $ei ++) {
		$sql = 'insert into ' . DBINFO::$APPDBNAME . '.customfeaturetable(appid,featureindex,value) values(' . '\'' . $appid . '\'' . ',' . $dbrows [$ei] [1] . ',' . '\'' . $dbrows [$ei] [2] . '\'' . ');';
		$result = execSQL ( $con, $sql );
	}
	if ($featureset != "") {
		$sql = "update " . DBINFO::$APPDBNAME . ".appeditiontable set editionindex='" . $editionindex . "',featureset='" . $featureset . "' where appid='" . $appid . "'";
		$result = execSQL ( $con, $sql );
		insertLicenseHistory ( $con, $appid, $editionindex, LICENSE::$DURATIONOFDAYS, "1", 0, 0 );
	}
	$sql = "SELECT value FROM " . DBINFO::$APPDBNAME . ".editionvaluetable where editionindex = $editionindex and featureindex= " . LICENSE::$NOOFUSERS;
	$dbrows = getResultArray ( $con, $sql );
	$noofuser = $dbrows [0] [0];
	$sql = "SELECT count(1) FROM table_6_frm where account_status='Active';";
	$dbrows = getResultArray ( $con, $sql );
	$activeusercount = $dbrows [0] [0];
	if ($noofuser < $activeusercount) {
		$limit = $activeusercount - $noofuser;
		$sql = "SELECT table_6_id FROM table_6_frm  order by createdon desc limit 0," . $limit;
		$dbrows = getResultArray ( $con, $sql );
		$idlist = "";
		for($ei = 0; $ei < sizeof ( $dbrows ); $ei ++) {
			$idlist .= $dbrows [$ei] [0];
			if ($ei != sizeof ( $dbrows ) - 1) {
				$idlist .= ",";
			}
		}
		if ($idlist != "") {
			$sql = "update table_6_frm set account_status='Inactive' where table_6_id in ( " . $idlist . ")";
			$result = execSQL ( $con, $sql );
		}
	}
}
function getDateFields($con, $formname) {
	$result = array ();
	$sql = 'select label from formfieldtable where formname = ' . '\'' . $formname . '\'' . ' and type = ' . '\'' . 'date' . '\'';
	$dbrows = getResultArray ( $con, $sql );
	for($i = 0; $i < sizeof ( $dbrows ); $i ++) {
		$result [] = $dbrows [$i] [0];
	}
	return $result;
}
function getTimeFields($con, $formname) {
	$result = array ();
	$sql = 'select label from formfieldtable where formname = ' . '\'' . $formname . '\'' . ' and type = ' . '\'' . 'Time' . '\'';
	$dbrows = getResultArray ( $con, $sql );
	for($i = 0; $i < sizeof ( $dbrows ); $i ++) {
		$result [] = $dbrows [$i] [0];
	}
	return $result;
}
function getDateTimeFields($con, $formname) {
	$result = array ();
	$sql = 'select label from formfieldtable where formname = ' . '\'' . $formname . '\'' . ' and type in (' . '\'' . 'Date_Time' . '\'' . ',' . '\'' . 'form_history' . '\'' . ') and name not in (' . '\'' . 'table_6_0_createdusername' . '\'' . ',' . '\'' . 'table_6_1_updatedusername' . '\'' . ',' . '\'' . 'table_6_2_viewedusername' . '\'' . ')';
	$dbrows = getResultArray ( $con, $sql );
	for($i = 0; $i < sizeof ( $dbrows ); $i ++) {
		$result [] = $dbrows [$i] [0];
	}
	return $result;
}
function isFormDetailsModified($con, $formname, $lasttime) {
	$ismodified = false;
	$sql = "select * from formwisemodifiedddetails where formname = '$formname' and updated_time > '$lasttime'";
	$dbrows = getResultArray ( $con, $sql );
	if (sizeof ( $dbrows ) > 0) {
		$ismodified = true;
	}
	return $ismodified;
}
function checkReferenceFieldValue($con, $formname, $fieldkey, $fieldvalue) {
	debug ( "Field Value ######## $fieldvalue" );
	debug ( "Field Key ######## $fieldkey" );
	if ($fieldvalue == "") {
		return "";
	}
	$fieldvalue=mysql_escape_string($fieldvalue);
	$nthins = substr ( $fieldkey, 1 + strlen ( $formname ) );
	$refformname = substr ( $nthins, strpos ( $nthins, "table" ), - 3 );
	$refid = "";
	$tokens = explode ( '@', $fieldvalue );
	if ($tokens === false) {
	} else {
		if (sizeof ( $tokens ) == 2) {
			$refid = $tokens [1];
			$type = $tokens [0];
			if ($type == "group") {
				$refformname = $refformname . "_group";
			}
			if ($refid == "") {
				return $fieldvalue;
			}
		} else {
			$refid = $fieldvalue;
		}
		debug ( "Ref IDDDDDDDDDD ######## $refid" );
		$sql = 'select * from ' . $refformname . '_frm where ' . $refformname . '_id = ' . '\'' . $refid . '\'';
		debug ( "SELECT QUERY @########### $sql" );
		$dbrows = getResultArray ( $con, $sql );
		if (sizeof ( $dbrows ) == 0) {
			if (! is_numeric ( $fieldvalue )) {
				$sql = "select reffieldname from formfieldreference where formname='$formname' and refformname='$refformname' and fieldname='$fieldkey'";
				$refdetailarr = getResultArray ( $con, $sql );
				if (sizeof ( $refdetailarr ) > 0) {
					$reffieldname = $refdetailarr [0] [0];
					$sql = "select " . $refformname . "_id from " . $refformname . "_frm where $reffieldname='$fieldvalue'";
					$refvalueidarr = getResultArray ( $con, $sql );
					if (sizeof ( $refvalueidarr ) > 0) {
						$refid = $refvalueidarr [0] [0];
						return $refid;
					}
				}
			}
		} else {
			return $fieldvalue;
		}
	}
	
	return "";
}
function isRecordAlreadyModified($lastupdatedtime, $dbupdatedtime) {
	if ($lastupdatedtime == "" || $lastupdatedtime == 'NULL') {
		return false;
	}
	if ($dbupdatedtime == "" || $dbupdatedtime == 'NULL') {
		return false;
	}
	$date1 = strtotime ( $lastupdatedtime );
	$date2 = strtotime ( $dbupdatedtime );
	$ismodified = $date2 > $date1;
	return $ismodified;
}
function isAutoLogEnabled($con, $username) {
	$sql = "SELECT Autolog from mobilelogconfig where Username = '$username'";
	$autologarr = getResultArray ( $con, $sql );
	if (sizeof ( $autologarr ) > 0) {
		if ($autologarr [0] [0] == '1') {
			return true;
		} else {
			return false;
		}
	}
}
function getOrganizationDetail($con) {
	$appid = getAppid ();
	if (isset ( $GLOBALS [$appid . "_orgdetail"] )) {
		$orglist = $GLOBALS [$appid . "_orgdetail"];
	} else {
		$sql = 'select * from table_21_frm;';
		$orglist = getResultArray ( $con, $sql );
		$GLOBALS [$appid . "_orgdetail"] = $orglist;
	}
	return $orglist [0];
}
function setOrganizationTimeZone($con) { // UTC_TIMEZONE_SUPPORT
	if (! IsTimeZoneSupport ()) {
		$orgdetails = getOrganizationDetail ( $con );
		$orgtimezone = $orgdetails [OrgizationMaster::$ORG_MASTER_TIMEZONE_INDEX];
		if ($orgtimezone != '') {
			$orgtimezonearr = explode ( ")-", $orgtimezone );
			if (sizeof ( $orgtimezonearr ) > 1) {
				date_default_timezone_set ( $orgtimezonearr [1] );
			} else {
				date_default_timezone_set ( $orgtimezonearr [0] );
			}
		} else {
			date_default_timezone_set ( 'Asia/Kolkata' );
		}
	} else {
		date_default_timezone_set ( 'UTC' );
	}
}
function getOrganizationTZOffset($con) { // UTC_TIMEZONE_SUPPORT
	$remote_tz = "UTC";
	$origin_tz = "";
	$orgdetails = getOrganizationDetail ( $con );
	$userid = getUserId ( $con );
	$sessionkey=$userid."_time_zone";
	if(isset($GLOBALS [$sessionkey])){
	$usertimezone=$GLOBALS [$sessionkey];
	}else{
	$sql = "select Time_Zone from table_6_frm where table_6_id = '$userid'";
	$resultrows = getResultArray ( $con, $sql );
	$usertimezone = $resultrows [0] [0];
	$GLOBALS [$sessionkey]=$usertimezone;
	}	
	if ($usertimezone != "" || $usertimezone != NULL) {
		$orgtimezone = $usertimezone;
	} else {
		$orgtimezone = $orgdetails [OrgizationMaster::$ORG_MASTER_TIMEZONE_INDEX];
	}
	if ($orgtimezone != '') {		
		$orgtimezonearr = explode ( ")-", $orgtimezone );
		if (sizeof ( $orgtimezonearr ) > 1) {
			$origin_tz = $orgtimezonearr [1];
		} else {
			$origin_tz = $orgtimezonearr [0];
		}		
	} else {
		$origin_tz = 'Asia/Kolkata';
	}	
	$origin_dtz = new DateTimeZone ( $origin_tz );
	$remote_dtz = new DateTimeZone ( $remote_tz );
	$origin_dt = new DateTime ( "now", $origin_dtz );
	$remote_dt = new DateTime ( "now", $remote_dtz );
	$offset = $origin_dtz->getOffset ( $origin_dt ) - $remote_dtz->getOffset ( $remote_dt );
	if(!IsTimeZoneSupport()){
		$offset = 0;
	}
	return $offset;
}
function getOrganizationGMTTZFormat($con) {// UTC_TIMEZONE_SUPPORT	
    $gmtformat='+05:30';
	$orgdetails = getOrganizationDetail ( $con );
	$userid = getUserId ( $con );
	$sessionkey=$userid."_time_zone";
	if(isset($GLOBALS [$sessionkey])){
	$usertimezone=$GLOBALS [$sessionkey];
	}else{
	$sql = "select Time_Zone from table_6_frm where table_6_id = '$userid'";
	$resultrows = getResultArray ( $con, $sql );
	$usertimezone = $resultrows [0] [0];
	$GLOBALS [$sessionkey]=$usertimezone;
	}	
	if ($usertimezone != "" || $usertimezone != NULL) {
		$orgtimezone = $usertimezone;
	} else {
		$orgtimezone = $orgdetails [OrgizationMaster::$ORG_MASTER_TIMEZONE_INDEX];
	}
	if ($orgtimezone != '') {
		$orgtimezonearr = explode ( ")-", $orgtimezone );
		if (sizeof ( $orgtimezonearr ) > 1) {
			$origin_tz = $orgtimezonearr [0];
			$orgtimezonefmtarr = explode ( " ", $origin_tz );
			$gmtformat=$orgtimezonefmtarr[1];			
		} 
	} 
	return trim($gmtformat);
}
function getTZOffset($tz){
	$origin_dtz = new DateTimeZone ( $tz );
	$remote_dtz = new DateTimeZone ( "UTC" );
	$origin_dt = new DateTime ( "now", $origin_dtz );
	$remote_dt = new DateTime ( "now", $remote_dtz );
	$offset = $origin_dtz->getOffset ( $origin_dt ) - $remote_dtz->getOffset ( $remote_dt );
	if(!IsTimeZoneSupport()){
		$offset = 0;
	}
	return $offset;
}
function getOrganizationTimeZone($con,$appid) {
	$sql = "select Time_Zone from " . DBINFO::$APPDBNAME . "".$appid.".table_21_frm";
	$result = getResultArray($con,$sql);
	$orgtimezone = $result[0][0];
	if ($orgtimezone != '') {
		$orgtimezonearr = explode ( ")-", $orgtimezone );
		if (sizeof ( $orgtimezonearr ) > 1) {
			$origin_tz = $orgtimezonearr [1];
	} 	else {
			$origin_tz = $orgtimezonearr [0];
	  	}
	}	
	if(	$origin_tz == ''){
		$origin_tz = 'Asia/Kolkata';
	}
	return $origin_tz;
}

function getConvertedDateTimeByTZ($tzoffset, $datetime, $byutcformat, $format="Y-m-d H:i:s") { // UTC_TIMEZONE_SUPPORT
	if ($datetime != "") {
		$dttimeinsecs = strtotime ( $datetime );
		if ($byutcformat) {
			$dttimeinsecs = $dttimeinsecs - $tzoffset;
		} else {
			$dttimeinsecs = $dttimeinsecs + $tzoffset;
		}
		$datetime = date ( $format, $dttimeinsecs );
	}
	return $datetime;
}
function getConvertedTimeByTZ($tzoffset, $time, $byutcformat) { // UTC_TIMEZONE_SUPPORT
	if ($time != "") {
		$timeinsecs = strtotime ( $time );
		if ($byutcformat) {
			$timeinsecs = $timeinsecs - $tzoffset;
		} else {
			$timeinsecs = $timeinsecs + $tzoffset;
		}
		$time = date ( "H:i:s", $timeinsecs );
	}
	return $time;
}
function getCurrentdateandtime($con) {
	$result = array ();
	$fieldvalue=date('Y-m-d H:i:s');
	if(IsTimeZoneSupport ()){
	$tzoffset = getOrganizationTZOffset ( $con );
	$fieldvalue = getConvertedDateTimeByTZ ( $tzoffset, $fieldvalue, false );
	}
	$result [0] = $fieldvalue;
	return $result;
}
function getCurrentdate($con) {
	$result = array ();
	$fieldvalue=date('Y-m-d H:i:s');
	if(IsTimeZoneSupport ()){
	$tzoffset = getOrganizationTZOffset ( $con );
	$fieldvalue = getConvertedDateTimeByTZ ( $tzoffset, $fieldvalue, false );
	}
	$datearr=explode(" ", $fieldvalue);
	return $datearr[0];
}
function getLogoutPageURL($con, $productid) {
	$sql = "select loginpage from " . DBINFO::$APPDBNAME . ".saasconfig where productid ='$productid'";
	$resultrows = getResultArray ( $con, $sql );
	$loginpage = $resultrows [0] [0];
	return $loginpage;
}
function getSignupTemplate($con, $user, $emailid, $password, $currentdate, $license_end_Date, $loginurl, $activation_link, $productid, $packagename) {
	$logoimg = getImageUrl ( "mclogo.png" );
	$productname = getProductNameFromProductId ( $con, $productid );
	$producttitle = getProductTitle ( $con, $productid );
	$productname = strtoupper ( $productname );
	$activation_link = prepareUrl ( $activation_link );
	if ($packagename != "") {
		$playstorelink = "";
		$playstore = "";
		$download = "";
	} else {
		$playstorelink = APPINFO::$PLAYSTORE_LINK;
		$playstore = 'After activating your account, you can download Cratio CRM Mobile App from Google Play Store ';
		$download = '(Download) ';
	}
	$temp = "<html>
	<head>
		<title></title>
	</head>
	<body>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			&nbsp;</p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f747-a060-d843-ed4ba992203c' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Hello $user,</span></b></p>
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f747-a060-d843-ed4ba992203c' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Thank you for registering with Cratio CRM Software. To confirm your registration please click on the activation button below.</span></b></p>
		<br />
		<br />		
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: center;'>
			<b id='docs-internal-guid-724c83b1-f747-a060-d843-ed4ba992203c' style='font-weight:normal;'><a href=\"$activation_link\" style='text-decoration:none;'><span style='font-size: 18.666666666666664px; font-family: Arial; color: rgb(255, 255, 255); background-color: rgb(234, 85, 85); vertical-align: baseline; white-space: pre-wrap;padding-bottom: 11px; padding-top: 11px; padding-left: 18px; padding-right: 18px; border-radius: 5px;'>Activate My Account Now</span></a></b></p>
		<br />
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f747-a060-d843-ed4ba992203c' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>$playstore </span><a href=$playstorelink style='text-decoration:none;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(17, 85, 204); background-color: rgb(255, 255, 255); text-decoration: underline; vertical-align: baseline; white-space: pre-wrap;'>$download</span></a>&amp;<span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Use your signup email &amp; password for login.</span></b></p>
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f747-a060-d843-ed4ba992203c' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>For any questions </span><a href='http://support.cratio.com/support/tickets/new' style='text-decoration:none;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(17, 85, 204); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>please click here to reach Cratio Support Desk.</span></a><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'> Look forward to serving your business needs. </span></b></p>
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f747-a060-d843-ed4ba992203c' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Thank You,</span></b></p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f747-a060-d843-ed4ba992203c' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Cratio Team.</span></b></p>
	</body>
</html>
";
	
	return $temp;
}
function getProductName($con, $appid) {
	$parr = explode ( "_", $appid );
	if (sizeof ( $parr ) == 3) {
		$productid = $parr [0];
	}
	$sql = "select productname from " . DBINFO::$COMMONDBNAME . ".productdetails where product_id ='$productid'";
	$resultrows = getResultArray ( $con, $sql );
	$productname = $resultrows [0] [0];
	$productname = strtolower ( $productname );
	return $productname;
}
function getReportSchedulerTemplate($con, $reportname, $username, $appid, $serverpath, $hostedurl) {
	$productname = getProductName ( $con, $appid );
	if ($productname == "") {
		$productname = "Hosted";
	}
	$sql = "select Organization_Name,Website from " . DBINFO::$APPDBNAME . "$appid.table_21_frm;";
	$resultrows = getResultArray ( $con, $sql );
	$orgname = $resultrows [0] [0];
	$orgwebsite = $resultrows [0] [1];
	$logoimg = $hostedurl . "Content/images/logo.png";
	$temp = "<html>
	<head>
		<title></title>
	</head>
	<body>
		<p dir='ltr' style='line-height:1.38;margin-top:4pt;margin-bottom:0pt;margin-right: 11pt;'>
			<b id='docs-internal-guid-724c83b1-b9dc-4a43-b7ae-c3c64aeaa386' style='font-weight:normal;'><span style='font-size:15px;font-family:Arial;color:#434343;background-color:#ffffff;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>Hi $username,</span><span style='font-size:13px;font-family:Arial;color:#222222;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'> </span></b></p>
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:4pt;margin-bottom:0pt;margin-right: 11pt;'>
			<b id='docs-internal-guid-724c83b1-b9dc-4a43-b7ae-c3c64aeaa386' style='font-weight:normal;'><span style='font-size:15px;font-family:Arial;color:#434343;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>This is automatic report sent from </span><span style='font-size:15px;font-family:Arial;color:#434343;background-color:#ffffff;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>Cratio</span><span style='font-size:15px;font-family:Arial;color:#434343;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'> based on your configuration. </span></b></p>
		<p dir='ltr' style='line-height:1.38;margin-top:4pt;margin-bottom:0pt;margin-right: 11pt;'>
			<b id='docs-internal-guid-724c83b1-b9dc-4a43-b7ae-c3c64aeaa386' style='font-weight:normal;'><span style='font-size:15px;font-family:Arial;color:#434343;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>Please find the attached </span><span style='font-size:15px;font-family:Arial;color:#434343;background-color:#ffffff;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>($reportname)</span><span style='font-size:15px;font-family:Arial;color:#434343;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'> report for your kind reference. </span></b></p>
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:4pt;margin-bottom:0pt;margin-right: 11pt;'>
			<b id='docs-internal-guid-724c83b1-b9dc-4a43-b7ae-c3c64aeaa386' style='font-weight:normal;'><span style='font-size:15px;font-family:Arial;color:#434343;background-color:#ffffff;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>Note:</span><span style='font-size:15px;font-family:Arial;color:#434343;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>Contact your administrator,If attached report has any problems.</span><span style='font-size:13px;font-family:Arial;color:#222222;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'> </span></b></p>
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:4pt;margin-bottom:0pt;margin-right: 11pt;'>
			<b id='docs-internal-guid-724c83b1-b9dc-4a43-b7ae-c3c64aeaa386' style='font-weight:normal;'><span style='font-size:15px;font-family:Arial;color:#434343;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>Regards,</span></b></p>
		<p dir='ltr' style='line-height:1.38;margin-top:4pt;margin-bottom:0pt;margin-right: 11pt;'>
			<b id='docs-internal-guid-724c83b1-b9dc-4a43-b7ae-c3c64aeaa386' style='font-weight:normal;'><span style='font-size:15px;font-family:Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>$orgname</span></b></p>
			<p dir='ltr' style='line-height:1.38;margin-top:4pt;margin-bottom:0pt;margin-right: 11pt;'>
			<b id='docs-internal-guid-724c83b1-b9dc-4a43-b7ae-c3c64aeaa386' style='font-weight:normal;'><span style='font-size:15px;font-family:Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>$orgwebsite</span></b></p>
	</body>
</html>

";
	return $temp;
}
function getReportDailySchedulerTemplate($con, $reportname, $username, $appid, $serverpath, $hostedurl) {
	$productname = getProductName ( $con, $appid );
	if ($productname == "") {
		$productname = "Hosted";
	}
	$sql = "select Organization_Name,Website from " . DBINFO::$APPDBNAME . "$appid.table_21_frm;";
	$resultrows = getResultArray ( $con, $sql );
	$orgname = $resultrows [0] [0];
	$orgwebsite = $resultrows [0] [1];
	$logoimg = $hostedurl . "Content/images/logo.png";
	$temp = "<html>
	<head>
		<title></title>
	</head>
	<body>
		<p>
			&nbsp;</p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-fa750194-e27b-44b3-5b77-512d28f2e03e' style='font-weight:normal;'><span style='font-size: 14.666666666666666px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;'>Hi $username, </span></b></p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-fa750194-e27b-44b3-5b77-512d28f2e03e' style='font-weight:normal;'><span style='font-size: 14.666666666666666px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;'>Please find Automated Daily Reports in this mail based on your account configuration. Please login to your web application for other reports.</span></b></p>
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-fa750194-e27b-44b3-5b77-512d28f2e03e' style='font-weight:normal;'><span style='font-size: 14.666666666666666px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;'>Regards,</span></b></p>
		<p>
			<b id='docs-internal-guid-fa750194-e27b-44b3-5b77-512d28f2e03e' style='font-weight:normal;'><span style='font-size: 14.666666666666666px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;'>$orgname</span></b></p>
			<b id='docs-internal-guid-fa750194-e27b-44b3-5b77-512d28f2e03e' style='font-weight:normal;'><span style='font-size: 14.666666666666666px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;'>$orgwebsite</span></b></p>
	</body>
</html>
";
	return $temp;
}
function getNewUserCreationTemp($con, $username, $loginurl, $usermailid, $password, $isNew) {
	if($loginurl == ""){
	$loginurl=APPINFO::$LOGIN_URL;	
	}	
	$playstore_link=APPINFO::$PLAYSTORE_LINK;
	$productid = getProductId ();
	$productname = getProductNameFromProductId ( $con, $productid );
	$producttitle = getProductTitle ( $con, $productid );
	$productname = strtoupper ( $productname );
	$orgdetail = getOrganizationDetail ( $con );
	$orgname = $orgdetail [1];
	$logoimg = getImageUrl ( "mclogo.png" );
	if ($isNew) {
		$operation = "created";
	} else {
		$operation = "reseted";
	}
	if ($productname == "") {
		$productname = "CRM";
	}
	if ($producttitle == "") {
		$producttitle = "Customer Relationship Management";
	}
	$temp = "<html>
	<head>
		<title></title>
	</head>
	<body>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			&nbsp;</p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f74c-cb4d-a831-5705173f1fe4' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Hi $username,</span></b></p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f74c-cb4d-a831-5705173f1fe4' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Your Cratio CRM Software Login has been created, please find the details below</span></b></p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			&nbsp;</p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-b9d3-0b04-81fd-010bca60e22f' style='font-weight:normal;'><span style='font-size:13px;font-family:Arial;color:#222222;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>User Name: </span><span style='font-size:13px;font-family:Arial;color:#1155cc;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>$usermailid</span></b></p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-b9d3-0b04-81fd-010bca60e22f' style='font-weight:normal;'><span style='font-size:13px;font-family:Arial;color:#222222;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>Password: &nbsp;$password</span></b></p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-b9d3-0b04-81fd-010bca60e22f' style='font-weight:normal;'><span style='font-size:13px;font-family:Arial;color:#222222;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>Click the url to access your account! (</span><a href='$loginurl' style='text-decoration:none;'><span style='font-size:13px;font-family:Arial;color:#1155cc;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:underline;vertical-align:baseline;white-space:pre-wrap;'>Login</span></a><span style='font-size:13px;font-family:Arial;color:#222222;background-color:#ffffff;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre-wrap;'>)</span></b></p>
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			&nbsp;</p>
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f74d-1e27-13c4-fe0d9d1199e0' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>You can download Cratio CRM Mobile App from Google Play Store </span><a href='$playstore_link' style='text-decoration:none;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(17, 85, 204); background-color: rgb(255, 255, 255); text-decoration: underline; vertical-align: baseline; white-space: pre-wrap;'>(Download)</span></a><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'> &amp; use the above mentioned login credentials to login.</span></b></p>
		<br />
		<p dir='ltr' style='line-height:1.38;margin-top:0pt;margin-bottom:0pt;'>
			<b id='docs-internal-guid-724c83b1-f74d-1e27-13c4-fe0d9d1199e0' style='font-weight:normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'>Regards,</span></b></p>
		<p dir='ltr' style='margin-top: 0pt; margin-bottom: 0pt;'>
			<b id='docs-internal-guid-724c83b1-f74d-1e27-13c4-fe0d9d1199e0' style='font-weight: normal;'><span style='line-height: 1.38; font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap;'></span><span style='font-family: Arial; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); vertical-align: baseline; white-space: pre-wrap; font-size: 15px; line-height: 20px;'>$orgname</span></b></p>
	</body>
</html>

    ";
	return $temp;
}
function getIntroMailTemp() {
	$logoimg = getImageUrl ( "mclogo.png" );
	$temp = "<table width=\"100%\">
<tbody><tr>
<td align=\"left\&quot;\"><font face=\"serif;\" size=\"5\"><b>Welcome to Cratio &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</b></font></td>
<td align=\"right\"><img src=\"$logoimg\" height=\"40\" width=\"150\"></td>
</tr>
</tbody></table>
    <span style=\"font-size:15px;font-family:'Circular',Helvetica,Open Sans,Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">&nbsp;</span>
    <hr color=\"#38ACEC\" style=\"height:1px;\">
    <span style=\"font-size:15px;font-family:'Circular',Helvetica,Open Sans,Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"></span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">Hello!</span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"></span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">Thank you for signing up Cratio CRM! </span><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">I'm

 Sunil, your CRM Support manager, and I'll be available to help you to
use our products better &amp; you can reach me anytime for any
assistance.</span><span style=\"font-size:15px;font-family:'Circular',Helvetica,Open Sans,Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"></span><br><span style=\"font-size:15px;font-family:'Circular',Helvetica,Open Sans,Arial;color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"></span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">You can go through the product documentation at </span><a href=\"http://www.cratio.com/crm/help\"><span style=\"font-size:15px;font-family:'Times New Roman';color:#1155cc;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:underline;vertical-align:baseline;\">www.cratio.com/crm/help</span></a><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">. Alternatively you can contact our support team by raising support ticket anytime by accessing our helpdesk at </span><a href=\"http://support.cratio.com\"><span style=\"font-size:15px;font-family:'Times New Roman';color:#1155cc;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:underline;vertical-align:baseline;\">http://support.cratio.com</span></a><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">. We shall close all your queries swiftly.</span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"></span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">Weâ€™re confident that Cratio CRM will become a valuable tool for your business and we look forward to having you on board!</span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"></span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"></span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">Warm Regards,</span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"></span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">Mr. Sunil,</span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">Account Management Team,</span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"></span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">+91 - 9092 198 198</span><br><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\">CRATIO.</span><br><a href=\"mailto:sunil@cratio.com\"><span style=\"font-size:15px;font-family:'Times New Roman';color:#1155cc;background-color:transparent;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:underline;vertical-align:baseline;\">sunil@cratio.com</span></a><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:bold;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"></span><br><a href=\"http://www.cratio.com/\"><span style=\"font-size:15px;font-family:'Times New Roman';color:#1155cc;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:underline;vertical-align:baseline;\">www.cratio.com</span></a><span style=\"font-size:15px;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:normal;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;\"> </span><br>";
	return $temp;
}
function getHelpDeskTemp($username,$reportingto,$mailid,$mobileno,$sub,$msg,$currenttime,$organization) {
	$orgname = "Organization : ";
	if($organization == ""){
		$orgname = "";
	}
	$temp = "<html><head><title></title></head><body><p style='MARGIN: 0px 0px 0px 40px;'><strong>New help desk mail from the user!!</strong></p><table border='0' cellpadding='3' cellspacing='0' width='100%'><tbody><tr><td width='20%'>&nbsp;</td><td width='1%'>&nbsp;</td><td width='65%'>&nbsp;</td><tr><td><blockquote style='BORDER-RIGHT: medium none; PADDING-RIGHT: 0px; BORDER-TOP: medium none; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px 0px 0px 40px; BORDER-LEFT: medium none; PADDING-TOP: 0px; BORDER-BOTTOM: medium none'><strong>$orgname</strong></blockquote></td><td></td><td>$organization</td></tr></tr><tr><td><blockquote style='BORDER-RIGHT: medium none; PADDING-RIGHT: 0px; BORDER-TOP: medium none; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px 0px 0px 40px; BORDER-LEFT: medium none; PADDING-TOP: 0px; BORDER-BOTTOM: medium none'><strong>Username</strong></blockquote></td><td>:</td><td>$username</td></tr><tr><td><blockquote style='BORDER-RIGHT: medium none; PADDING-RIGHT: 0px; BORDER-TOP: medium none; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px 0px 0px 40px; BORDER-LEFT: medium none; PADDING-TOP: 0px; BORDER-BOTTOM: medium none'><strong>Reporting To</strong></blockquote></td><td>:</td><td>$reportingto</td></tr><tr><td><blockquote style='BORDER-RIGHT: medium none; PADDING-RIGHT: 0px; BORDER-TOP: medium none; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px 0px 0px 40px; BORDER-LEFT: medium none; PADDING-TOP: 0px; BORDER-BOTTOM: medium none'><strong>Contact Mail ID</strong></blockquote></td><td>:</td><td>$mailid</td><tr><td><blockquote style='BORDER-RIGHT: medium none; PADDING-RIGHT: 0px; BORDER-TOP: medium none; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px 0px 0px 40px; BORDER-LEFT: medium none; PADDING-TOP: 0px; BORDER-BOTTOM: medium none'><strong>Mobile</strong></blockquote></td><td>:</td><td>$mobileno</td></tr><tr><td><blockquote style='BORDER-RIGHT: medium none; PADDING-RIGHT: 0px; BORDER-TOP: medium none; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px 0px 0px 40px; BORDER-LEFT: medium none; PADDING-TOP: 0px; BORDER-BOTTOM: medium none'><strong>Subject</strong></blockquote></td><td>:</td><td>$sub</td></tr><tr><td><blockquote style='BORDER-RIGHT: medium none; PADDING-RIGHT: 0px; BORDER-TOP: medium none; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px 0px 0px 40px; BORDER-LEFT: medium none; PADDING-TOP: 0px; BORDER-BOTTOM: medium none'><strong>Date/Time</strong></blockquote></td><td>:</td><td>$currenttime</td></tr><tr><td><blockquote style='BORDER-RIGHT: medium none; PADDING-RIGHT: 0px; BORDER-TOP: medium none; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px 0px 0px 40px; BORDER-LEFT: medium none; PADDING-TOP: 0px; BORDER-BOTTOM: medium none'><strong>Message</strong></blockquote></td><td>:</td><td>$msg</td></tr></tbody></table></body></html>";
	return $temp;
}
function getForgotPasswordTemp($username, $resetlink, $emailid, $orgname) {
	$resetlink = prepareUrl ( $resetlink );
	$logoimg = getImageUrl ( "mclogo.png" );
	$temp = "<html>
	<head>
		<title></title>
	</head>
	<body>
		<p dir='ltr' style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;'>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='font-weight: normal;'><span style='font-size: 24px; font-family: Arial; font-weight: 700; vertical-align: baseline; white-space: pre-wrap;'>Password Reset Instructions &nbsp;<img alt='' src='http://cloud.cratio.com/apps/Content/images/logo.png' style='height: 68px; width: 150px; float: right;' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></b></p>
		<p dir='ltr' style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;'>
			<b style='font-weight: normal;'><span style='font-size: 24px; font-family: Arial; font-weight: 700; vertical-align: baseline; white-space: pre-wrap;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></b></p>
		<hr />
		<p style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: normal;'>
			<b style='line-height: 1.656; font-weight: normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); vertical-align: baseline; white-space: pre-wrap;'>Hi $username,</span></b></p>
		<p style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: normal;'>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='line-height: 1.656; font-weight: normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); vertical-align: baseline; white-space: pre-wrap;'>We have received a request to reset your Cratio CRM Software password.</span></b></p>
		<p dir='ltr' style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: 1.656; margin-top: 0pt; margin-bottom: 0pt;'>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='font-weight: normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); vertical-align: baseline; white-space: pre-wrap;'>If you did not make this request, simply ignore this email and everything will be fine. If you did make this request just click the link below to get yourself a new password.</span></b></p>
		<p dir='ltr' style='text-align:center;color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: 1.656; margin-top: 0pt; margin-bottom: 0pt; text-align: center;'>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='font-weight: normal;'><a href='$resetlink' style='text-decoration: none;'><span style='font-size: 18px; font-family: Arial; color: rgb(255, 255, 255); background-color: rgb(48, 133, 31); vertical-align: baseline; white-space: pre-wrap;padding-bottom: 8px; padding-top: 8px; padding-left: 18px; padding-right: 18px; border-radius: 5px;'>Set New Password</span></a></b></p>
		<p>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium;font-weight: normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); vertical-align: baseline; white-space: pre-wrap;'>Thank you,</span></b></p>
		<p style='line-height: 1px;'>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium;  font-weight: normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); vertical-align: baseline; white-space: pre-wrap;'>$orgname</span></b></p>

		<div>
			&nbsp;</div>
	</body>
</html>

    ";
	return $temp;
}

function getEmailActivationMail($username, $resetlink, $emailid, $orgname) {
	$resetlink = prepareUrl ( $resetlink );
	$logoimg = getImageUrl ( "mclogo.png" );
	$temp = "<html>
	<head>
		<title></title>
	</head>
	<body>
		<p dir='ltr' style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;'>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='font-weight: normal;'><span style='font-size: 24px; font-family: Arial; font-weight: 700; vertical-align: baseline; white-space: pre-wrap;'>Email Verification Process &nbsp;<img alt='' src='http://cloud.cratio.com/apps/Content/images/logo.png' style='height: 68px; width: 150px; float: right;' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></b></p>
		<p dir='ltr' style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;'>
			<b style='font-weight: normal;'><span style='font-size: 24px; font-family: Arial; font-weight: 700; vertical-align: baseline; white-space: pre-wrap;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></b></p>
		<hr />
		<p style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: normal;'>
			<b style='line-height: 1.656; font-weight: normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); vertical-align: baseline; white-space: pre-wrap;'>Hi $username,</span></b></p>
		<p style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: normal;'>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='line-height: 1.656; font-weight: normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); vertical-align: baseline; white-space: pre-wrap;'>Thank you for registering with Cratio CRM Software. To confirm your registration email by click on the verification button below..</span></b></p>
		<p dir='ltr' style='text-align:center;color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; line-height: 1.656; margin-top: 0pt; margin-bottom: 0pt; text-align: center;'>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='font-weight: normal;'><a href='$resetlink' style='text-decoration: none;'><span style='font-size: 18px; font-family: Arial; color: rgb(255, 255, 255); background-color: rgb(48, 133, 31); vertical-align: baseline; white-space: pre-wrap;padding-bottom: 8px; padding-top: 8px; padding-left: 18px; padding-right: 18px; border-radius: 5px;'>Subscribe!</span></a></b></p>
		<p>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium;font-weight: normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); vertical-align: baseline; white-space: pre-wrap;'>Thank you,</span></b></p>
		<p style='line-height: 1px;'>
			<b id='docs-internal-guid-39d7b80e-6efa-f101-d0dd-50fe7b6a0848' style='color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium;  font-weight: normal;'><span style='font-size: 13.333333333333332px; font-family: Arial; color: rgb(34, 34, 34); vertical-align: baseline; white-space: pre-wrap;'>$orgname</span></b></p>

		<div>
			&nbsp;</div>
	</body>
</html>

    ";
	return $temp;
}

function ProcessCloudTelephoney($con, $obj) {
	$operation = $obj->{OPERATIONTYPE::$KEY};
	if ($operation == "clicktocall") {
		$response = processClickToCall ( $con, $obj );
		return $response;
	}
}
function getCloudTelephonyConfigDetails($con, $appid) {
	$sql = "select * from " . DBINFO::$APPDBNAME . ".ctintegration where appid='$appid'";
	$resultrows = getResultArray ( $con, $sql );
	$responsearr = $resultrows [0];
	return $responsearr;
}
function processClickToCall($con, $obj) {
	$fromno = $obj->{'fromno'};
	$tono = $obj->{'tono'};
	$appid = $obj->{'APPID'};
	$responsearr = getCloudTelephonyConfigDetails ( $con, $appid );
	if (sizeof ( $responsearr ) == 0) {
		setError ( "Error: Please verify the Apikey and phone no configuration" );
		return "";
	}
	$provider = $responsearr [2];
	$apikey = $responsearr [3];
	$phoneno = $responsearr [4];
	$username = $responsearr [5];
	if ($provider == "Knowlarity") {
$kplan = $responsearr [6];
$datainfo=array();
$datainfo['k_number']="+91".$phoneno;
$datainfo['agent_number']="+91".$fromno;
$datainfo['customer_number']="+91".$tono;
$data_string=json_encode($datainfo);
$ch = curl_init('https://kpi.knowlarity.com/'.$kplan.'/v1/account/call/makecall');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//curl_setopt($ch, CURLOPT_HEADER, false);			
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string),'Accept: application/json','Authorization: '.$apikey,'x-api-key: '.$username));
$result = curl_exec($ch);
$json_a = json_decode($result, true);		
		$status = "";
		foreach ( $json_a as $key => $value_a ) {			
			if($key == 'success'){
			$status = 'success';	
			}else{
			$status = $value_a ['message'];	
			}		
		}
setError ( $status );
	} else {
		$sql="show fields from table_6_frm where field='OZ_User';";
		$resultrows = getResultArray ( $con, $sql );
		if(sizeof($resultrows) == 0){
		setError ( "Error: Please verify the apikey and username configuration to this number($fromno) in user form." );
		return "";	
		}
		$sql="select oz_user,oz_api_key from table_6_frm where mobileno='$fromno' and oz_user <> '' and oz_api_key <> '';";
		$resultrows = getResultArray ( $con, $sql );
		if(sizeof($resultrows) == 0){
		setError ( "Error: Please verify the apikey and username configuration to this number($fromno) in user form." );
		return "";	
		}
		$username=$resultrows[0][0];
		$apikey=$resultrows[0][1];
		//$url = "http://cloudagent.in/CAServices/PhoneManualDial.php?apiKey=$apikey&userName=$username&custNumber=$tono&phoneName=$fromno&did=$phoneno";
		$url = "http://cloudagent.in/calite/c2capi.html?number=$tono&username=$username&apiKey=$apikey";		
		$content = file_get_contents ( $url );		
		$response = json_decode ( $content, true );
		$status = $response ["status"];		
		if ($status == "success") {
			$status = "success";
			setError ( $status );
		} else if ($status == "error") {
			setError ( $response ["messages"][0] );
		}
	}	
	return $status;
}
function getLicenseHistoryInfo($con, $obj) {
	$appid = $obj->{'APPID'};
	$sql = "select lh.id,lh.index,lh.type,lh.date_time,lh.closingbalance,lh.newaddition,lh.current_available,lh.remarks,lh.startdate,lh.enddate,lh.editionindex from " . DBINFO::$APPDBNAME . ".licensehistory lh where appid='$appid' order by date_time";
	$resultrows = getResultArray ( $con, $sql );
	$size = sizeof ( $resultrows );
	for($i = 0; $i < $size; $i ++) {
		$index = $resultrows [$i] [1];
		$type = $resultrows [$i] [2];
		$editionindex = $resultrows [$i] [10];
		if ($type == 'Addon') {
			$name = getAddonNameFormIndex ( $con, $index );
			$resultrows [$i] [1] = $name;
		} else if ($type == 'Edition') {
			$name = getEditionNameFormIndex ( $con, $editionindex );
			$resultrows [$i] [1] = $name;
		} else {
			$name = getLicenseFeatureNameFormIndex ( $con, $index );
			$resultrows [$i] [1] = $name;
		}
	}
	return $resultrows;
}
function getEditionNameFormIndex($con, $editionindex) {
	$sql = "select name from " . DBINFO::$APPDBNAME . ".editiontable where editionindex='$editionindex'";
	$resultrows = getResultArray ( $con, $sql );
	return $resultrows [0] [0];
}
function getLicenseFeatureNameFormIndex($con, $index) {
	$sql = "select name from " . DBINFO::$APPDBNAME . ".featuretable where featureindex='$index'";
	$resultrows = getResultArray ( $con, $sql );
	return $resultrows [0] [0];
}
function getAddonNameFormIndex($con, $index) {
	$sql = "select name from " . DBINFO::$APPDBNAME . ".addonconfig where id='$index'";
	$resultrows = getResultArray ( $con, $sql );
	return $resultrows [0] [0];
}
function getEmailIdFromUserName($con, $username) {
	$sql = "select emailid from table_6_frm where name='$username'";
	$resultrows = getResultArray ( $con, $sql );
	return $resultrows [0] [0];
}
function insertCpanelHistory($con, $obj) {
	migrateCpanelHistory ( $con );
	$username = getUserName ();
	$operation = $obj->{OPERATIONTYPE::$KEY};
	$operation = ucfirst ( strtolower ( $operation ) );
	if (isset ( $obj->{"appid"} )) {
		$appid = $obj->{"appid"};
	} else {
		$appid = "";
	}
	$nextid = getNextIdValue ( $con, DBINFO::$APPDBNAME . ".cpanelhistory", "table_id" );
	$sql = "insert into " . DBINFO::$APPDBNAME . ".cpanelhistory(table_id,username,operation,appid) values('$nextid','$username','$operation','$appid')";
	$result = execSQL ( $con, $sql );
	$sql = "delete from " . DBINFO::$APPDBNAME . ".cpanelhistory where createdtime < DATE_SUB(NOW(), INTERVAL 1 MONTH)";
	$result = execSQL ( $con, $sql );
}
function getActiveUserCount($con, $appid) {
	$dbname = DBINFO::$APPDBNAME . $appid;
	$sql = "select total_active from " . $dbname . ".licenseinfo;";
	$resultArr = getResultArray ( $con, $sql );
	$activeusercount = $resultArr [0] [0];
	return $activeusercount;
}
function getRemainingUserCount($con, $appid) {
	$tablename = DBINFO::$APPDBNAME . $appid . ".licenseinfo";
	$sql = "select number_of_user,total_active from $tablename";
	$resultArr = getResultArray ( $con, $sql );
	$noofuser = $resultArr [0] [0];
	$totalactive = $resultArr [0] [1];
	$remainingusers=0;	
	if ($noofuser == COMMONCONSTANTS::$UNLIMITED_STRING) {
		$remainingusers = 100;
	} else {
		$remainingusers = $noofuser - $totalactive;
	}	
	return $remainingusers+0;
}
function isMySqlReservedWord($con, $name) {
	$exists = in_array ( strtoupper ( $name ), CRATIOMYSQL::$FORBIDDONWORD );
	return $exists;
}
function getNumberMatchedDetails($con, $caller_id) {
	$msgstr = "";
	$sql = "SELECT * FROM cloudtelephoneyconfig";
	$resultarr = getResultArray ( $con, $sql );
	$usernamearr = array ();
	for($i = 0; $i < sizeof ( $resultarr ); $i ++) {
		$id = $resultarr [$i] [0];
		$modulename = $resultarr [$i] [1];
		$formname = $resultarr [$i] [2];
		$formlabel = $resultarr [$i] [3];
		$checkfields = $resultarr [$i] [4];
		$displayfields = $resultarr [$i] [5];
		$displayuserfields = $resultarr [$i] [6];
		$defaultuser = $resultarr [$i] [7];
		$isshowonlineuser = $resultarr [$i] [8];
		$resultset = explode ( ",", $checkfields );
		$cond = " where ";
		for($mi = 0; $mi < sizeof ( $resultset ); $mi ++) {
			$colname = $resultset [$mi];
			$colname = getFieldNameByLabel ( $con, $formname, $colname );
			$cond = $cond . "('%$caller_id%'" . " Like CONCAT('%', $colname ,'%') and $colname != '')";
			if ($mi != sizeof ( $resultset ) - 1) {
				$cond = $cond . " or ";
			}
		}
		$isdispalyfieldresult = explode ( ",", $displayfields );
		$fnamestr = $formname . "_id";
		for($fi = 0; $fi < sizeof ( $isdispalyfieldresult ); $fi ++) {
			$name = $isdispalyfieldresult [$fi];
			$name = getFieldNameByLabel ( $con, $formname, $name );
			if ($name != "") {
				$fnamestr = $fnamestr . "," . $name;
			}
		}
		$sql = "SELECT $fnamestr FROM " . $formname . "_frm $cond";
		$dbrows = getResultAsscData ( $con, $sql );
		if ($msgstr != "") {
			$msgstr = $msgstr . "@#";
		}
		if (sizeof ( $dbrows ) > 0) {
			forEach ( $dbrows [0] as $fieldkey => $value ) {
				if ($formname . "_id" == $fieldkey) {
					$userfieldarr = explode ( ",", $displayuserfields );
					if ($displayuserfields != "" && sizeof ( $userfieldarr ) == 0) {
						$userfieldarr [] = $displayuserfields;
					}
					for($ui = 0; $ui < sizeof ( $userfieldarr ); $ui ++) {
						$userfield = $userfieldarr [$ui];
						$userfield = getFieldNameByLabel ( $con, $formname, $userfield );
						$sql = "select $userfield from " . $formname . "_frm where $fieldkey = '$value'";
						// echo "user echo=" . $sql;
						$userres = getResultArray ( $con, $sql );
						$userid = $userres [0] [0];
						if ($userid != "") {
							if (! in_array ( $userid, $usernamearr )) {
								$usernamearr [] = $userid;
							}
						}
					}
				}
				$fieldtype = getFormFieldType ( $con, $formname, $fieldkey );
				if ($fieldtype == FieldType::$REFERENCE || $fieldtype == FieldType::$ENTITY_GROUP) {
					$rowrefdetail = getReferenceFieldDetailWithOutModule ( $con, $formname, $formname, $fieldkey );
					$refformname = $rowrefdetail [0] [0];
					$reffieldname = $rowrefdetail [0] [1];
					$reftablename = $refformname . "_frm";
					$sql = "select $reffieldname from $reftablename where $refformname" . "_id ='$value';";
					$resulrarray = getResultArray ( $con, $sql );
					if (sizeof ( $resulrarray ) > 0) {
						$value = $resulrarray [0] [0];
					}
				}
				$fieldname = getFieldLabelName ( $con, $formname, $fieldkey );
				$msgstr = $msgstr . $fieldname . " : " . $value . ",";
			}
		}
		$msgstr = $msgstr . "formname:" . $formname . ",formlabel:$formlabel";
		
		$defaultuserarr = explode ( ",", $defaultuser );
		if ($defaultuser != "" && sizeof ( $defaultuserarr ) == 0) {
			$defaultuserarr [] = $defaultuser;
		}
		for($ui = 0; $ui < sizeof ( $defaultuserarr ); $ui ++) {
			$username = $defaultuserarr [$ui];
			// echo "default user name =" . $username . "\n";
			$userid = getUserIdFromUserName ( $con, $username );
			if (! in_array ( $userid, $usernamearr )) {
				$usernamearr [] = $userid;
			}
		}
	}
	$responsearr = array ();
	$responsearr [] = $usernamearr;
	$responsearr [] = $msgstr;
	return $responsearr;
}
function setSaasMobileDB($con, $obj, $appid, $productid, $editionindex, $userid) {
	$cw = getcwd ();
	$userid="0";
	$formnameFolder = $fname = str_replace ( "dacamweb", '', $cw );
	$rootpath = $formnameFolder;
	$formnameFolder = $formnameFolder . DIRECTORY_SEPARATOR . "DB";
	$rootpath = $formnameFolder . DIRECTORY_SEPARATOR . $appid;
	if (! is_dir ( $rootpath )) {
		$old = umask ( 0 );
		mkdir ( $rootpath, 0777 );
		umask ( $old );
		$saasfolder = $formnameFolder . DIRECTORY_SEPARATOR . $productid . "_" . $editionindex . "_saas";
		if (! file_exists ( $saasfolder ) && ! is_dir ( $saasfolder )) {
			return false;
		}
		recurse_copy ( $saasfolder, $rootpath );
		shell_exec ( "chmod -R 777 " . $rootpath );
		// chmod($rootpath, 0777);
		rename ( $rootpath . "/cratio_app_.db", $rootpath . "/cratio_app_" . $userid . ".db" );
		$sourcefile = "cratio_app_" . $userid . ".db";
		$destfile = $rootpath;
		debug ( "Source " . $sourcefile . " Dest " . $destfile );
		$sourcemdbpath = $rootpath . DIRECTORY_SEPARATOR . $sourcefile;
		$destinationmdbpath = $rootpath . DIRECTORY_SEPARATOR . "cratio_app_0.db";
		//copy ( $sourcemdbpath, $destinationmdbpath );
		if (! in_array ( $appid, NativeCustomers::$NATIVE_CUSTOMERS_IDS )) {
			Zipcreator ( $destfile, $sourcefile );			
			if (file_exists ( $sourcemdbpath )) {
				chmod ( $sourcemdbpath, 0777 );
				unlink ( $sourcemdbpath );
			}
		}
		$sqlfile = $destfile . "/cratio_app_.sql";
		if (file_exists ( $sqlfile )) {
			chmod ( $sqlfile, 0777 );
			unlink ( $sqlfile );
		}
	}
	$sql = "select createdtime from " . DBINFO::$APPDBNAME . "." . $productid . "_" . $editionindex . "_orginfo where appid = '$appid'";
	$resultarr = getResultArray ( $con, $sql );
	$size = getMobileSize ( $rootpath . "/cratio_app_" . $userid . ".db" );
	$sql = "delete from filehistory where userid='$userid'";
	$result = execSQL ( $con, $sql );
	$sql = "insert into filehistory values ('$userid','" . $resultarr [0] [0] . "','Completed','$size','','','')";
	$result = execSQL ( $con, $sql );
}
function recurse_copy($src, $dst) {
	$dir = opendir ( $src );
	while ( false !== ($file = readdir ( $dir )) ) {
		if (($file != '.') && ($file != '..')) {
			if (is_dir ( $src . '/' . $file )) {
				recurse_copy ( $src . '/' . $file, $dst . '/' . $file );
			} else {
				copy ( $src . '/' . $file, $dst . '/' . $file );
			}
		}
	}
	closedir ( $dir );
}
function getMobileSize($filename) {
	$size = filesize ( $filename );
	$size = number_format ( $size / 1048576, 2 );
	return $size;
}
function insertCDRInformation($con, $displayno,$destination, $caller_id, $calltype, $resource_url, $action, $start_time, $end_time, $seconds, $type,$call_id="",$timezone="") {
	$formname = "table_37";
	$formtablename = getFormTableName ( $formname );
	$formidkey = $formname . "_id";
	$start_time = getValidDate ( $start_time );
	$end_time = getValidDate ( $end_time );
	if($timezone != ""){
	 $tzoffset=getTZOffset($timezone);
     if($tzoffset > 0){
	 $end_time = getConvertedDateTimeByTZ ( $tzoffset, $end_time, true );		
	}	
	}		
	//$File = "sr.txt";
	//$Handle = fopen($File, 'w');
	//$Data = $displayno . "\n";
	//fwrite($Handle, $Data);	
	$nextid = getFormMaxId ( $con, $formtablename );
	$currenttime = date ( "Y-m-d H:i:s" );
	//fwrite($Handle, "\n".$resource_url."\n");	
	if($resource_url != ","){
	$resource_url = $resource_url . ",Download";
	}
	//$loginfo="\nCaller ID::".$caller_id.",Start Time::".$start_time.",End Time::".$end_time.",Resource URL::".$resource_url.",Call ID::".$call_id.",Caller ID::".$caller_id.",Destination::".$destination."\n";
	//fwrite($Handle, $loginfo);	
	$sql = "insert into $formtablename ($formidkey,Caller_No,Receiver,Call_Type,Start_DateTime,End_DateTime
    ,Durationsec,Record_url,Action,table_6_0_table_6_id,createdon,table_6_1_table_6_id,updatedon)
    values('$nextid','$caller_id','$destination','$calltype','$start_time','$end_time','$seconds','$resource_url','$action',0,
    '$currenttime',0,'$currenttime')";
	 //fwrite($Handle, $sql);
	$result = execSQL ( $con, $sql );
	if ($result) {
		updateFormMaxId ( $con, $formtablename, $nextid );
	}
	if ($type == 'callSRNo') {
		if($calltype == 'incoming')
		{
		$destination=$caller_id;
		if(strlen($caller_id) > 10){
		$destination = substr($caller_id, -10);	
		}	
		}else{
		if(strlen($destination) > 10){
		$destination = substr($destination, -10);	
		}	
		}
		$destination=trim($destination);
		if(!is_numeric($destination)){
		return;	
		}				
		$sql = "SELECT * FROM formfieldreference where formname='$formname' and refformname !='table_6'";
		//fwrite ( $Handle, $sql );
		$resultarr = getResultArray ( $con, $sql );
		for($i = 0; $i < sizeof ( $resultarr ); $i ++) {
			$reffieldname = $resultarr [$i] [2];
			$refmodulename = $resultarr [$i] [3];
			$refformname = $resultarr [$i] [4];
			$sql = "SELECT * FROM cloudtelephoneyconfig where formname='$refformname'";		
			$telepconfigarr = getResultArray ( $con, $sql );
			if(sizeof($telepconfigarr) > 0){
			$checkfields = $telepconfigarr [0] [4];
			$resultset = explode ( ",", $checkfields );
			$cond = " where ";
			for($mi = 0; $mi < sizeof ( $resultset ); $mi ++) {
				$colname = $resultset [$mi];
				$colname = getFieldNameByLabel($con, $refformname, $colname);
				$cond = $cond . "('%$destination%'" . " Like CONCAT('%', $colname ,'%') and $colname != '')";
				if ($mi != sizeof ( $resultset ) - 1) {
					$cond = $cond . " or ";
				}
			}
			$sql = "SELECT $refformname" . "_id FROM " . $refformname . "_frm $cond";
			fwrite ( $Handle, $sql );
			$resultdata = getResultArray ( $con, $sql );
			if (sizeof ( $resultdata ) > 0) {
				$refid = $resultdata [0] [0];
				$refmappingtablename = "0" . $refformname . "_" . $formtablename;
				$sql = "insert into $refmappingtablename values('$refid','$nextid')";
				//fwrite ( $Handle, $sql );
				$result = execSQL ( $con, $sql );
				$sql = "update $formtablename set $reffieldname ='$refid' where $formidkey ='$nextid'";
				//fwrite ( $Handle, $sql );
				$result = execSQL ( $con, $sql );
			}	
			}			
		}
	}
	// print "Data Written";
	// fclose($Handle);
}
function getValidDate($datestring) {
	$datearr = explode ( ".", $datestring );
	if (sizeof ( $datearr ) > 0) {
		$datestring = $datearr [0];
		if (strpos ( $datestring, "+" ) === false) {
		} else {
			$datearr = explode ( "+", $datestring );
			$datestring = $datearr [0];
		}
	}
	return $datestring;
}
function getAbsTimeFromTimeStr($date) {
	$arr = strptime ( $date, '%H:%M:%S' );
	return $arr ['tm_hour'] * 60 * 60 + $arr ['tm_min'] * 60 + $arr ['tm_sec'];
}
function convertAbsTimeValue($secs) {
	$d = $secs;
	$hrs = floor ( $secs / (60 * 60) );
	$secs -= ($hrs * 60 * 60);
	$mins = floor ( $secs / 60 );
	$secs -= ($mins * 60);
	$secs = floor ( $secs );
	
	if ($mins < 10)
		$mins = '0' . $mins;
	if ($secs < 10)
		$secs = '0' . $secs;
	
	return $hrs . ':' . $mins . ':' . $secs; // .':'.$d;
}
function updateDefaultShiftTime($con, $tableid) {
	$sql = "update table_6_frm set table_39_0_table_39_id = '0' where table_6_id='$tableid'";
	$result = execSQL ( $con, $sql );
	$sql = "insert into 3table_39_table_6_frm values('0','$tableid')";
	$result = execSQL ( $con, $sql );
}
function isDefaultshiftTimePresent($con) {
	$ispresent = false;
	$sql = "select Shift_Name from table_39_frm where table_39_id='0'";
	$result = getResultArray ( $con, $sql );
	if (sizeof ( $result ) > 0) {
		$ispresent = true;
	}
	
	return $ispresent;
}
function getCurrentAttachmentSize($con) {
	$size = 0.0;
	$sql = "select attachment_storage_size from licenseinfo";
	$resultarr = getResultArray ( $con, $sql );
	if (sizeof ( $resultarr ) > 0) {
		$sizestr = $resultarr [0] [0];
		$size = floatval ( $sizestr );
	}
	return $size;
}
function getPasswordSalt() {
	return substr ( str_pad ( dechex ( mt_rand () ), 8, '0', STR_PAD_LEFT ), - 8 );
}
function preparePasswordHash($password) {
	$salt = getPasswordSalt ();
	return $salt . (hash ( 'whirlpool', $salt . $password ));
}
function getPasswordHash($salt, $password) {
	return $salt . (hash ( 'whirlpool', $salt . $password ));
}
function comparePassword($password, $hash) {
	$salt = substr ( $hash, 0, 8 );
	return $hash == getPasswordHash ( $salt, $password );
}
function isS3Enabled($con, $appid) {
	if (isset ( $GLOBALS [$appid . "_f25"] )) {
		$issaveinaws = $GLOBALS [$appid . "_f25"];
	} else {
		$sql = "select f25 from " . DBINFO::$APPDBNAME . ".applicationlist where appid = '$appid';";
		$result = getResultArray ( $con, $sql );
		$issaveinaws = $result [0] [0];
		$GLOBALS [$appid . "_f25"] = $issaveinaws;
	}
	
	return $issaveinaws;
}
function getS3BucketName() {
	$currdirectory = getFolderBase ();
	$bucketname = 'cratiocontents';
	if (strpos ( $currdirectory, '/var/www/apps' ) !== false) {
		$bucketname = S3_VALUES::$APPS_BUCKETNAME;
	} else if (strpos ( $currdirectory, '/var/www/qc' ) !== false) {
		$bucketname = S3_VALUES::$QC_BUCKETNAME;
	} else if (strpos ( $currdirectory, '/var/www/i' ) !== false) {
		$bucketname = S3_VALUES::$I_BUCKETNAME;
	}else if (strpos ( $currdirectory, '/var/www/getsales' ) !== false) {
		$bucketname = S3_VALUES::$APPS_GETSALES_BUCKETNAME;
	}else if (strpos ( $currdirectory, '/var/www/leadsroll' ) !== false) {
		$bucketname = S3_VALUES::$APPS_LEADSROLL_BUCKETNAME;
	} else {
		$bucketname = S3_VALUES::$HOSTED_BUCKETNAME;
	}
	return $bucketname;
}
function getRemoteDBConnection($dbtype, $dbhost, $dbuser, $dbpwd, $dbname) {
	if ($dbtype == "Mysql") {
		$appspdoconn = new RemotePDOConnection ( $dbtype, $dbhost, $dbuser, $dbpwd, $dbname );
	} else if ($dbtype == "Oracle") {
		$appspdoconn = getODBConnection ( $dbhost, $dbname, $dbuser, $dbpwd );
	} else if ($dbtype == "Mssql") {
		$appspdoconn = getMssqlConnection ( $dbhost, $dbname, $dbuser, $dbpwd );
	}
	return $appspdoconn;
}
function getMQLTableColumnDetails($conn, $tablename) {
	$columnarray = array ();
	$query = "show columns from $tablename";
	try {
		$result = getResultArray ( $conn, $query );
		for($i = 0; $i < sizeof ( $result ); $i ++) {
			$columnarray [] = $result [$i] [0];
		}
	} catch ( Exception $e ) {
		$msg = $e->getMessage ();
		setError ( $msg );
	}
	return $columnarray;
}
function getDateValue($year, $days, $month, $min, $hours, $isdayneed) {
	$datevalue = mktime ( $hours, $min, 0, $month, $days, $year );
	$datestr = date ( DATE_ATOM, $datevalue );
	if ($isdayneed) {
		$datevalue = date ( 'l-Y-m-d H:i', strtotime ( $datestr ) );
	} else {
		$datevalue = date ( 'Y-m-d H:i', strtotime ( $datestr ) );
	}
	return $datevalue;
}
function getYearValue($value) {
	$currentdatetime = date ( "Y-m-d" );
	$datearray = explode ( "-", $currentdatetime );
	$year = $datearray [0];
	$month = $datearray [1];
	$days = $datearray [2];
	$valuearr = stringSplitByDelimit ( $value, "," );
	if (sizeof ( $valuearr ) == 3) {
		$month = getMonthIndex ( $valuearr [0] );
		$days = $valuearr [1];
		$hamin = $valuearr [2];
		$harr = stringSplitByDelimit ( $hamin, ":" );
		$hours = $harr [0];
		$min = $harr [1];
		$datevalue = getDateValue ( $year, $days, $month, $min, $hours, true );
	} else {
		$nthweek = getWeekIndex ( $valuearr [0] ) - 1;
		$day = $valuearr [1];
		$month = getMonthIndex ( $valuearr [2] );
		$hamin = $valuearr [3];
		$harr = stringSplitByDelimit ( $hamin, ":" );
		$hours = $harr [0];
		$min = $harr [1];
		$returnarr = getWeekArray ( $month, $hours, $min );
		if ($nthweek == "-2") {
			$nthweek = sizeof ( $returnarr ) - 1;
		}
		for($i = 0; $i < sizeof ( $returnarr [$nthweek] ); $i ++) {
			$date = $returnarr [$nthweek] [$i];
			$darray = explode ( "-", $date );
			$cday = $darray [0];
			if ($cday == $day) {
				$datevalue = $date;
			}
		}
	}
	return $datevalue;
}
function getMonthValue($value) {
	$currentdatetime = date ( "Y-m-d" );
	$datearray = explode ( "-", $currentdatetime );
	$year = $datearray [0];
	$valuearr = stringSplitByDelimit ( $value, "," );
	if (sizeof ( $valuearr ) == 3) {
		$days = $valuearr [0];
		$month = $valuearr [1];
		$hamin = $valuearr [2];
		$harr = stringSplitByDelimit ( $hamin, ":" );
		$hours = $harr [0];
		$min = $harr [1];
		$datevalue = getDateValue ( $year, $days, $month, $min, $hours, true );
	} else {
		$nthweek = getWeekIndex ( $valuearr [0] ) - 1;
		$day = $valuearr [1];
		$month = $valuearr [2];
		$hamin = $valuearr [3];
		$harr = stringSplitByDelimit ( $hamin, ":" );
		$hours = $harr [0];
		$min = $harr [1];
		$returnarr = getWeekArray ( $month, $hours, $min );
		if ($nthweek == "-2") {
			$nthweek = sizeof ( $returnarr ) - 1;
		}
		for($i = 0; $i < sizeof ( $returnarr [$nthweek] ); $i ++) {
			$date = $returnarr [$nthweek] [$i];
			$darray = explode ( "-", $date );
			$cday = $darray [0];
			if ($cday == $day) {
				$datevalue = $date;
			}
		}
	}
	return $datevalue;
}
function getDailyDateValue($value, $year, $month, $days) {
	$valuearr = stringSplitByDelimit ( $value, "," );
	$value = $valuearr [0];
	$hamin = $valuearr [1];
	$harr = stringSplitByDelimit ( $hamin, ":" );
	$hours = $harr [0];
	$min = $harr [1];
	if ($value == "-1") {
		$value = "0";
	}
	$days = $days + $value;
	$datevalue = getDateValue ( $year, $days, $month, $min, $hours, true );
	return $datevalue;
}
function getWeekValue($value) {
	$valuearr = stringSplitByDelimit ( $value, "," );
	$nthweek = $valuearr [0] - 1;
	$nthday = $valuearr [1];
	$hamin = $valuearr [2];
	$harr = stringSplitByDelimit ( $hamin, ":" );
	$hours = $harr [0];
	$min = $harr [1];
	$returnarr = getWeekArray ( date ( 'm' ), $hours, $min );
	for($i = 0; $i < sizeof ( $returnarr [$nthweek] ); $i ++) {
		$date = $returnarr [$nthweek] [$i];
		$darray = explode ( "-", $date );
		$cday = $darray [0];
		if ($cday == $nthday) {
			return $date;
		}
	}
}
function getWeekArray($month, $hours, $smin) {
	$end_date = date ( 'l-Y-m-d', strtotime ( '-1 second', strtotime ( '+1month', strtotime ( date ( $month ) . '/01/' . date ( 'Y' ) . '00:00:00' ) ) ) );
	$start_date = date ( "l-Y-m-d", strtotime ( date ( $month ) . '/01/' . date ( 'Y' ) . ' 00:00:00' ) );
	$datearray = explode ( "-", $start_date );
	$sday = $datearray [0];
	$syear = $datearray [1];
	$smonth = $datearray [2];
	$sdays = $datearray [3];
	$datearray = explode ( "-", $end_date );
	$edays = $datearray [3];
	$startindex = getDayIndex ( $sday );
	$returnarr = array ();
	while ( $sdays <= $edays ) {
		$weekarr = array ();
		for($i = $startindex; $i <= 6; $i ++) {
			$start_date = getDateValue ( $syear, $sdays, $smonth, $smin, $hours, true );
			if ($sdays <= $edays) {
				$weekarr [] = $start_date;
				$sdays ++;
			} else {
				break;
			}
		}
		$returnarr [] = $weekarr;
		$startindex = 0;
	}
	return $returnarr;
}
function getDayIndex($day) {
	if ($day == "Sunday") {
		$returnindex = 0;
	} else if ($day == "Monday") {
		$returnindex = 1;
	} else if ($day == "Tuesday") {
		$returnindex = 2;
	} else if ($day == "Wednesday") {
		$returnindex = 3;
	} else if ($day == "Thursday") {
		$returnindex = 4;
	} else if ($day == "Friday") {
		$returnindex = 5;
	} else if ($day == "Saturday") {
		$returnindex = 6;
	}
	return $returnindex;
}
function getMonthIndex($month) {
	if ($month == "jan") {
		$returnindex = 1;
	} else if ($month == "feb") {
		$returnindex = 2;
	} else if ($month == "mar") {
		$returnindex = 3;
	} else if ($month == "apr") {
		$returnindex = 4;
	} else if ($month == "may") {
		$returnindex = 5;
	} else if ($month == "jun") {
		$returnindex = 6;
	} else if ($month == "jul") {
		$returnindex = 7;
	} else if ($month == "aug") {
		$returnindex = 8;
	} else if ($month == "sep") {
		$returnindex = 9;
	} else if ($month == "oct") {
		$returnindex = 10;
	} else if ($month == "nov") {
		$returnindex = 11;
	} else if ($month == "dec") {
		$returnindex = 12;
	}
	return $returnindex;
}
function getWeekIndex($week) {
	if ($week == "First") {
		$returnindex = 1;
	} else if ($week == "Second") {
		$returnindex = 2;
	} else if ($week == "Third") {
		$returnindex = 3;
	} else if ($week == "Fourth") {
		$returnindex = 4;
	} else if ($week == "Last") {
		$returnindex = - 1;
	}
	return $returnindex;
}
function getTriggerSystemAction($con, $triggerid) {
	//$sasql = "select ns.formname,ns.feorbeaction, ns.typeofaction,ns.actiontxt,ns.status,ns.templatename from newsystemactiontable ns,triggersystemactiontable ts where ns.systemactionid = ts.systemactionid and ts.triggerid = '$triggerid';";
	//$sysaction = getResultArray ( $con, $sasql );
	$sysaction=getTriggerSystemActionFromSession($con, $triggerid);	
	$sysaction [0] [3] = html_entity_decode ( $sysaction [0] [3] );
	return $sysaction [0];
}
function replacespecialchar($string) {
	$string = str_replace ( "'", "\'", $string );
	return $string;
}
function getCpanelSMSTemplate($con, $obj) {
	$sql = 'select f12 from  ' . DBINFO::$APPDBNAME . '.applicationlist where appid=' . '\'' . getAppid () . '\'';
    $resultrows = getResultArray($con, $sql);
	$id=$resultrows[0][0];
	if($id != ""){
	$sql = "select smsprovider from " . DBINFO::$APPDBNAME . ".smsconfig where table_id='$id'";
	$result = getResultArray ( $con, $sql );	
	}else{
	$sql = "select smsprovider from " . DBINFO::$APPDBNAME . ".smsconfig where isdefault='1'";
	$result = getResultArray ( $con, $sql );	
	}	
	return $result [0] [0];
}
function getDBNameByLabel($fieldlabel) {
	$fieldlabel = preg_replace ( '/[^A-Za-z0-9_]/', '_', $fieldlabel ); // replace all speacial character with under score
	return $fieldlabel;
}
function getLiveRecordSearchString($con,$obj,$formname) {
	$reqfrom=$obj->{'requestfrom'};
	$filterstr="'1','2'";
	if($reqfrom == "Web"){
	$filterstr="'0','2'";
	}
	$sql = "select * from liverecordconfigtable where formname = '$formname' and isWebOrMobile in ($filterstr)";
	$liverecordres = getResultArray ( $con, $sql );
	$id = $liverecordres [0] [0];
	$lcond = $liverecordres [0] [3];
	$modulename = getModulename ( $con, $formname );
	$lcond = prepareAdvSearchCondition ( $con, $lcond, false, null, $modulename, $formname, false, $userid, true );
	return $lcond;
}
function getClientIP() {
	$ipaddress = '';
	if ($_SERVER ['REMOTE_ADDR'])
		$ipaddress = $_SERVER ['REMOTE_ADDR'];
	else if ($_SERVER ['HTTP_CLIENT_IP'])
		$ipaddress = $_SERVER ['HTTP_CLIENT_IP'];
	else if ($_SERVER ['HTTP_X_FORWARDED_FOR'])
		$ipaddress = $_SERVER ['HTTP_X_FORWARDED_FOR'];
	else if ($_SERVER ['HTTP_X_FORWARDED'])
		$ipaddress = $_SERVER ['HTTP_X_FORWARDED'];
	else if ($_SERVER ['HTTP_FORWARDED_FOR'])
		$ipaddress = $_SERVER ['HTTP_FORWARDED_FOR'];
	else if ($_SERVER ['HTTP_FORWARDED'])
		$ipaddress = $_SERVER ['HTTP_FORWARDED'];	
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}
function getGEOLocationByIP() {
	$ipaddress = getClientIP ();
	$details = json_decode ( file_get_contents ( "http://ip-api.com/json/$ipaddress" ) );
	$locationdetails = "ip:$ipaddress,";
	foreach ( $details as $key => $value ) {
		if (($key == "city" || $key == "country" || $key == "lat" || $key == "lon" || $key == "regionName") && $value != "") {
			$locationdetails .= $key . ":" . $value . ",";
		}
	}
	$locationdetails = lastchartrim ( $locationdetails );
	return $locationdetails;
}
function decryptStringArray($stringArray, $key = "Cr@tioFsm#123") {
	$s = unserialize ( rtrim ( mcrypt_decrypt ( MCRYPT_RIJNDAEL_256, md5 ( $key ), base64_decode ( strtr ( $stringArray, '-_,', '+/=' ) ), MCRYPT_MODE_CBC, md5 ( md5 ( $key ) ) ), "\0" ) );
	return $s;
}
function encryptStringArray($stringArray, $key = "Cr@tioFsm#123") {
	$s = strtr ( base64_encode ( mcrypt_encrypt ( MCRYPT_RIJNDAEL_256, md5 ( $key ), serialize ( $stringArray ), MCRYPT_MODE_CBC, md5 ( md5 ( $key ) ) ) ), '+/=', '-_,' );
	return $s;
}
function prepareUrl($url, $key = "Cr@tioFsm#123") {
	$url = explode ( "?", $url, 2 );
	if (sizeof ( $url ) <= 1)
		return $url;
	else
		return $url [0] . "?params=" . encryptStringArray ( $url [1], $key );
}
function setREQUESTPARAM($params, $key = "Cr@tioFsm#123") {
	$params = decryptStringArray ( $params, $key );
	$param_pairs = explode ( '&', $params );
	foreach ( $param_pairs as $pair ) {
		$split_pair = explode ( '=', $pair );
		$_REQUEST [$split_pair [0]] = $split_pair [1];
	}
}
function sendSignupCopyToDap($appid, $mailid, $companyname, $productname) {
	$content = "Hi <b>Cratio,</b><br><br>The new user has been signed up our " . $productname . "  application.<br><br><b>Appid:</b>$appid<br><b>Account:</b>$companyname<br><b>Userid:</b>$mailid";
	$emailids = array ();
	$emailids [] = APPINFO::$SALES_MAIL_ID;
	$reason = smtpmail ( $emailids, "New Signup Alert", $content, "", "", false, "", "" );
}
function getUserListByReportingName($con, $name) {
	$reportelist = "";
	$sql = "select table_6_id from table_6_frm where Name='$name';";
	$userArr = getResultArray ( $con, $sql );
	if (sizeof ( $userArr > 0 )) {
		$userid = $userArr [0] [0];
		$sql = "select table_6_id from table_6_frm where table_6_3_table_6_id='$userid';";
		$ulist = getResultArray ( $con, $sql );
		for($i = 0; $i < sizeof ( $ulist ); $i ++) {
			$reportelist .= "'" . $ulist [$i] [0] . "',";
		}
		$reportelist = lastchartrim ( $reportelist );
	}
	if ($reportelist == "") {
		$reportelist = "-1";
	}
	return $reportelist;
}
function saveFirstTimeSetupChanges($con, $obj) {
	$tableid = $obj->{'id'};
	$orgname = $obj->{'Organization_Name'};
	$logo = $obj->{'Logo'};
	$emailid = $obj->{'Email_Id'};
	$phno1 = $obj->{'Phone_No_1'};
	$phno2 = $obj->{'Phone_No_2'};
	$website = $obj->{'Website'};
	$fiscalyear = $obj->{'Financial_Year_Start'};
	$currency = $obj->{'Default_Currency'};
	$tz = $obj->{'Time_Zone'};
	$apptitle = $obj->{'Display_Name'};
	$name = $obj->{'Name'};
	$designation = $obj->{'Designation'};
	$street1 = $obj->{'Street_1'};
	$street2 = $obj->{'Street_2'};
	$city = $obj->{'City'};
	$pincode = $obj->{'PinZip_Code'};
	$state = $obj->{'State'};
	$country = $obj->{'Country'};
	$logochanged = $obj->{'logochanged'};
	$username = getUserId ( $con );
	$currenttime = date ( 'Y-m-d H:i:s' );
	$formname = 'table_21';
	$formtablename = 'table_21_frm';
	if($apptitle == ""){
	$apptitle=$orgname;
	}
	if ($tableid == '') {
		$nextid = getFormMaxId ( $con, $formname );
		$issaveinaws = isS3Enabled ( $con, getAppid () );
		moveFile ( $logo, $formname, $nextid, "", "", $issaveinaws );
		$sql = "insert into $formtablename (" . $formname . "_id,Organization_Name,Logo,Email_Id,Phone_No_1,
				Phone_No_2,Website,Financial_Year_Start,Default_Currency,Time_Zone,Display_Name,Name,Designation,
				Street_1,Street_2,City,PinZip_Code,State,Country,Email_Status,SMS_Status,Date_Format,Settings_Mode,appid,table_6_0_table_6_id,createdon,table_6_1_table_6_id,updatedon,table_6_2_table_6_id,viewedon)
		       values('$nextid','$orgname','$logo','$emailid','$phno1','$phno2','$website','$fiscalyear','$currency','$tz','$apptitle','$name','$designation','$street1','$street2','$city','$pincode','$state','$country','Yes','Yes','DD-MM-YYYY','BASIC','" . getAppid () . "','$username','$currenttime','$username','$currenttime','$username','$currenttime')";
		$result = execSQL ( $con, $sql );
	} else {
		if ($logochanged == "1") {
			$issaveinaws = isS3Enabled ( $con, getAppid () );
			moveFile ( $logo, $formname, $tableid, "", "", $issaveinaws );
		}
		$sql = "update $formtablename set Organization_Name='$orgname',Logo='$logo',Email_Id='$emailid',
		Phone_No_1='$phno1',Phone_No_2='$phno2',Website='$website',Financial_Year_Start='$fiscalyear',
		Default_Currency='$currency',Time_Zone='$tz',Display_Name='$apptitle',Name='$name',Designation='$designation',Street_1='$street1',Street_2='$street2',City='$city',PinZip_Code='$pincode',State='$state',Country='$country',table_6_1_table_6_id='$username',updatedon='$currenttime' where table_21_id='$tableid'";
		$result = execSQL ( $con, $sql );
	}
	
	return "success";
}
function addDateTimeTextValue($val, $total) {
	if ($val == null || $val == "") {
		$val = "00:00:00";
	}
	if ($total == null || $total == "") {
		$total = "00:00:00";
	}
	$totalarr = stringSplitByDelimit ( $total, ":" );
	$valarr = stringSplitByDelimit ( $val, ":" );
	$value = "";
	if (sizeof ( $totalarr ) > 0 && sizeof ( $valarr ) > 0) {
		$totaldays = $totalarr [0];
		$totalhours = $totalarr [1];
		$totalmins = $totalarr [2];
		$valdays = $valarr [0];
		$valhours = $valarr [1];
		$valmins = $valarr [2];
		$finalmins = intval ( $valmins ) + intval ( $totalmins );
		$totalhours += $finalmins / 60;
		$finalmins = $finalmins % 60;
		$finalhours = intval ( $valhours ) + intval ( $totalhours );
		$totaldays += $finalhours / 24;
		$finalhours = $finalhours % 24;
		$finaldays = intval ( $totaldays ) + intval ( $valdays );
		if ($finaldays <= 9) {
			$finaldays = "0" . $finaldays;
		}
		if ($finalhours <= 9) {
			$finalhours = "0" . $finalhours;
		}
		if ($finalmins <= 9) {
			$finalmins = "0" . $finalmins;
		}
		$value = $finaldays . ":" . $finalhours . ":" . $finalmins;
	}
	return $value;
}
function insertDemodataInTask($con, $userid, $appid) {
	$sql = "select table_6_id from " . DBINFO::$APPDBNAME . $appid . ".table_6_frm where EmailId = '$userid'";
	$resultArray = getResultArray ( $con, $sql );
	$usertableid = $resultArray [0] [0];
	$currenttime = date ( "Y-m-d H:i:s" );
	$plusonehour = date ( 'Y-m-d H:i:s', strtotime ( '1 hours' ) );
	$tommorow = date ( 'Y-m-d H:i:s', strtotime ( '1 day' ) );
	$pluonehrtom = date ( 'Y-m-d H:i:s', strtotime ( $tommorow . "+1 hour" ) );
	$id = getFormMaxIdForInsertDummy ( $con, "table_52", $appid );
	$sql = "select formname from " . DBINFO::$APPDBNAME . $appid . ".formtable where labelname like '%Customer%'";
	$resultArray = getResultArray ( $con, $sql );
	$customerformname = $resultArray [0] [0] . "_frm";
	$customeridfield = $resultArray [0] [0] . "_id";
	$sql = "select $customeridfield from " . DBINFO::$APPDBNAME . $appid . ".$customerformname";
	$resultArray = getResultArray ( $con, $sql );
	$customeridval = $resultArray [0] [0];
	$sql = "insert into " . DBINFO::$APPDBNAME . $appid . ".table_52_frm (table_52_id,table_6_3_table_6_id,table_6_3_table_6_group_id,Subject,Status,Planned_Start,Planned_End,Actual_Start,Actual_End,Planned_Hours,Actual_Hours,Comments,trigger_action,Actual_Start_Location,Actual_Start_Location_latitude,Actual_Start_Location_longitude,Actual_End_Location,Actual_End_Location_latitude,Actual_End_Location_longitude,table_201_0_table_201_id,table_212_0_table_212_id,table_6_0_table_6_id,table_6_1_table_6_id,table_6_2_table_6_id,createdon,updatedon,viewedon)values('$id','$usertableid',NULL,'Sample Task Today','Open','$currenttime','$plusonehour','','','00:01:00','','','No','','','','','','','$customeridval',NULL,'0','0','0','$currenttime','$currenttime','$currenttime');";
	execSQL ( $con, $sql );
	$id = getFormMaxIdForInsertDummy ( $con, "table_52", $appid );
	$sql = "insert into " . DBINFO::$APPDBNAME . $appid . ".table_52_frm (table_52_id,table_6_3_table_6_id,table_6_3_table_6_group_id,Subject,Status,Planned_Start,Planned_End,Actual_Start,Actual_End,Planned_Hours,Actual_Hours,Comments,trigger_action,Actual_Start_Location,Actual_Start_Location_latitude,Actual_Start_Location_longitude,Actual_End_Location,Actual_End_Location_latitude,Actual_End_Location_longitude,table_201_0_table_201_id,table_212_0_table_212_id,table_6_0_table_6_id,table_6_1_table_6_id,table_6_2_table_6_id,createdon,updatedon,viewedon)values('$id','$usertableid',NULL,'Sample Task Tommorrow','Open','$tommorow','$pluonehrtom','','','00:01:00','','','No','','','','','','','$customeridval',NULL,'0','0','0','$currenttime','$currenttime','$currenttime');";
	execSQL ( $con, $sql );
	$id = getFormMaxIdForInsertDummy ( $con, "table_52", $appid );
	$sql = "insert into " . DBINFO::$APPDBNAME . $appid . ".table_52_frm (table_52_id,table_6_3_table_6_id,table_6_3_table_6_group_id,Subject,Status,Planned_Start,Planned_End,Actual_Start,Actual_End,Planned_Hours,Actual_Hours,Comments,trigger_action,Actual_Start_Location,Actual_Start_Location_latitude,Actual_Start_Location_longitude,Actual_End_Location,Actual_End_Location_latitude,Actual_End_Location_longitude,table_201_0_table_201_id,table_212_0_table_212_id,table_6_0_table_6_id,table_6_1_table_6_id,table_6_2_table_6_id,createdon,updatedon,viewedon)values('$id','$usertableid',NULL,'Sample Task Unscheduled','Open','','','','','','','','No','','','','','','','$customeridval',NULL,'0','0','0','$currenttime','$currenttime','$currenttime');";
	execSQL ( $con, $sql );
	updateFormModification ( $con, "table_52", $appid );
	$id = getFormMaxIdForInsertDummy ( $con, "table_41", $appid );
	$sql = "insert into " . DBINFO::$APPDBNAME . $appid . ".table_41_frm values ('$id','$currenttime','Kathipara Flyover Bridge Grand Southern Trunk Rd\, Rajeswari colony\,','13.007572','80.203735','','$usertableid',null,'$usertableid','$currenttime','$usertableid','$currenttime','$usertableid','$currenttime','','');";
	execSQL ( $con, $sql );
}
function getFormMaxIdForInsertDummy($con, $tablename, $appid) {
	$maxid = 0;
	$sql = "select id from " . DBINFO::$APPDBNAME . $appid . ".idgenerator where tablename='$tablename' FOR UPDATE ; ";
	$result = getResultSet ( $con, $sql );
	foreach ( $result as $dbrow ) {
		$maxid = $dbrow [0] + 1;
	}
	if ($maxid > 0) {
		$sql = "update " . DBINFO::$APPDBNAME . $appid . ".idgenerator set id='$maxid'  where tablename='$tablename';";
		$result = execSQL ( $con, $sql );
	} else {
		$maxid = $maxid + 1;
		$sql = "insert into " . DBINFO::$APPDBNAME . $appid . ".idgenerator value ('$tablename', '$maxid');";
		$result = execSQL ( $con, $sql );
	}
	return $maxid;
}
function updateFormModification($con, $formname, $appid) {
	$currenttime = date ( 'Y-m-d H:i:s' );
	$sql = "select * from " . DBINFO::$APPDBNAME . $appid . ".formwisemodifiedddetails where formname='$formname'";
	$resarr = getResultArray ( $con, $sql );
	if (sizeof ( $resarr ) == 0) {
		$sql = "insert into " . DBINFO::$APPDBNAME . $appid . ".formwisemodifiedddetails values('$formname','$currenttime')";
		execSQL ( $con, $sql );
	} else {
		$sql = "update " . DBINFO::$APPDBNAME . $appid . ".formwisemodifiedddetails set updated_time='$currenttime' where formname='$formname'";
		$result = execSQL ( $con, $sql );
	}
}
function IsTimeZoneSupport() {
	$appids = GeneralSettings::$APPIDFORDISABLETIMEZONE;
	$appid = getAppId ();
	if (strpos ( $appids, "," ) !== FALSE) {
		$appidarr = explode ( ",", $appids );
		if (in_array ( $appid, $appidarr )) {
			return false;
		}
	} else {
		if ($appid == $appids) {
			return false;
		}
	}
	return GeneralSettings::$TIMEZONE_SUPPORT;
}
function getRoleIdFromProfileIdForUpdate($con, $profileid) {
	$sql = "select table_4_id  from  table_4_frm where Role_Name  in (select profile_Name from table_2_frm where table_2_id = '$profileid' ); ";
	$result = getResultArray ( $con, $sql );
	return $result [0] [0];
}
function str_starts_with($haystack, $needle) {
	return strpos ( $haystack, $needle ) === 0;
}
function str_ends_with($haystack, $needle) {
	return strrpos ( $haystack, $needle ) + strlen ( $needle ) === strlen ( $haystack );
}

function performaddonmodulesaction($con,$requestobj){
$operation = $requestobj->{OPERATIONTYPE::$KEY};
$appid = $requestobj->{'appid'};
$response=array();
$dbname=DBINFO::$APPDBNAME . $appid;
if($operation == "GETALL"){
$sql=" select formname,labelname from " .$dbname . ".formtable where formtype in ('','request','checkin/checkout','config','Recurring','inputform') and (modulename not in('Setup','Settings','Reports','Calendar') or formname in ('table_49','table_37','table_41')) order by labelname";
$result = getResultArray ( $con, $sql );
$response[]=$result;
$sql="select formname,actionitems from " . $dbname. ".formactiontable where actionitems != '' and modulename not in('Setup','Reports');";
$result = getResultArray ( $con, $sql );
$response[]=$result;
$sql="select * from " . $dbname. ".addonforms;";
$result = getResultArray ( $con, $sql );
$response[]=$result;
$sql="select * from " . $dbname. ".addonformactions;";
$result = getResultArray ( $con, $sql );
$response[]=$result;
}else if($operation == "FORM_DETAILS_SAVE"){	
	$detailsarr=$requestobj->{'details'};
	$sql="delete from ".$dbname.".addonforms;";
	execSQL ( $con, $sql );
	   $values="";
		for($i=0;$i<sizeof($detailsarr);$i++){
		$values.="('".$detailsarr[$i]."'),";		
			
		}		
		if($values != ""){
		    $values = lastchartrim ( $values );	
			$sql="insert into ".$dbname.".addonforms values $values ;";
			execSQL ( $con, $sql );
		}
$response="success";
	
}else if($operation == "ACTION_DETAILS_SAVE"){
	$detailsarr=$requestobj->{'details'};
	$sql="delete from ".$dbname.".addonformactions;";
	execSQL ( $con, $sql );
     $values="";
	for($i=0;$i<sizeof($detailsarr);$i++){
		$detail=$detailsarr[$i];
		$actionarr = explode ( ",", $detail);
		$values.="("."'".$actionarr[0]."','".$actionarr[1]."'"."),";			
		}		
	if($values != ""){
		    $values = lastchartrim ( $values );	
			$sql="insert into ".$dbname.".addonformactions values $values;";
			execSQL ( $con, $sql );
		}
	$response="success";
}
return $response;
}

function processAutoPrefixEditor($con, $obj){
 $operation = $obj->{'OPERATION'};
 if($operation == "GetList"){
 	$sql = "select ft.formname,ffd.label,ffd.defaultvalue,apd.idvalue,apd.fieldname from autoprefixid apd left join formfieldtable ffd on ffd.name = apd.fieldname and ffd.formname = apd.formname left join formtable ft on ft.formname = ffd.formname order by ft.formname;";
	$result = getResultArray($con, $sql);
	return $result;
 }else if($operation == "SAVE"){
 	$fieldlabel = $obj->{'fieldname'};
	$default = $obj->{'default'};
	$autonumber = $obj->{'autonumber'};
	$formname = $obj->{'formname'};
	$formname =  getFormNamefromLable($con, $formname);
	$fieldlabel = getFieldNameByLabel($con, $formname, $fieldlabel);
	$sql = "SELECT defaultvalue FROM autoprefixid where formname= '$formname' and fieldname = '$fieldlabel'";
	$result = getResultArray($con, $sql);
	$defaultold = $result[0][0];
	if($defaultold != $default){
		$sql = "update autoprefixid set idvalue = '$autonumber',defaultvalue='$default' where formname = '$formname' and fieldname = '$fieldlabel';";
		$isexecute = execSQL($con, $sql);
		$sql = "update formfieldtable set defaultvalue = '$default' where formname = '$formname' and name = '$fieldlabel';";
		execSQL($con, $sql);		
	}else{
		$sql = "update autoprefixid set idvalue = '$autonumber' where formname = '$formname' and fieldname = '$fieldlabel';";
		$isexecute = execSQL($con, $sql);
	}
	return "success";
 }
}

function getFieldDefaultValue($con,$formname,$fieldname){
	$sql = "select defaultvalue from formfieldtable where formname = '$formname' and name = '$fieldname' ";
	$result = getResultArray($con, $sql);
	$defaultvalue  = $result[0][0];
	$defsplit = explode("date(",$defaultvalue);
	if(sizeof($defsplit) > 1){
		$finsplit = explode(")",$defsplit[1]);
		$datestrval = call_user_func("customdate",$finsplit[0]);
		$ostr = $finsplit[1];
		$defaultvalue = $datestrval.$ostr;
	}	
	return $defaultvalue;
}
function customdate($datestr){
	return date($datestr);
}
function getConditionResult($fvalue, $cstring, $svalue) {
	$fvalue = strtolower (trim($fvalue));
	$svalue = strtolower (trim($svalue));
	$fvaluearr = explode ( ",", $fvalue );
	$result = false;
	if ($cstring == "is") {
		for($i = 0; $i < sizeof ( $fvaluearr ); $i ++) {
			$fvalue = $fvaluearr [$i];			
			if ($fvalue == $svalue) {			
				$result = true;
			}
		}
	} else if ($cstring == "is not") {
		for($i = 0; $i < sizeof ( $fvaluearr ); $i ++) {
			$fvalue = $fvaluearr [$i];
			if ($fvalue != $svalue) {
				$result = true;
			}
		}
	} else if ($cstring == "begins with") {
		for($i = 0; $i < sizeof ( $fvaluearr ); $i ++) {
			$fvalue = $fvaluearr [$i];
			if (string_begins_with ( $svalue, $fvalue )) {
				$result = true;
			}
		}
	} else if ($cstring == "ends with") {
		for($i = 0; $i < sizeof ( $fvaluearr ); $i ++) {
			$fvalue = $fvaluearr [$i];
			if (EndsWith ( $svalue, $fvalue )) {
				$result = true;
			}
		}
	} else if ($cstring == "contains") {
		for($i = 0; $i < sizeof ( $fvaluearr ); $i ++) {
			$fvalue = $fvaluearr [$i];
			if (string_begins_with ( $svalue, $fvalue ) || strpos ( $svalue, $fvalue ) > 0 || EndsWith ( $svalue, $fvalue )) {
				$result = true;
			}
		}
	} else if ($cstring == "not contains") {
		for($i = 0; $i < sizeof ( $fvaluearr ); $i ++) {
			$fvalue = $fvaluearr [$i];
			if (! strpos ( $svalue, $fvalue ) > 0) {
				$result = true;
			}
		}
	}else if ($cstring == "is empty") {
	if ($svalue == "") {			
				$result = true;
			}
	}else if ($cstring == "is not empty") {
	if ($svalue != "") {			
				$result = true;
			}
	}
	return $result;
}
function updateSQLMonitorLog($con,$appid,$entity,$operation,$sqlcount){
	if(true){
	return;	
	}
$sql="create table if not exists " . DBINFO::$COMMONDBNAME . ".appsqlmonitorlog (
`appid` varchar(30) DEFAULT '',
`date` varchar(30) DEFAULT '',
`entity` varchar(100) DEFAULT '',
`operation` varchar(100) DEFAULT '',
`sqlcount` varchar(30) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$result = execSQL($con, $sql);
$currentdate = date('Y-m-d H:i:s');
$firstdayofcurrentmonth=date('Y-m-01');
$datearr=explode(" ", $currentdate);
$date=$datearr[0];
$time=$datearr[1];
$dayarr=explode("-", $date);
$timearr=explode(":", $time);
if($dayarr[2] == 1 && $timearr[0] == 1){
$sql="delete from " . DBINFO::$COMMONDBNAME . ".appsqlmonitorlog where date < '$firstdayofcurrentmonth'";
$result = execSQL($con, $sql);	
}
$sql="update " . DBINFO::$COMMONDBNAME . ".appsqlmonitorlog set sqlcount=sqlcount+'$sqlcount' where appid='$appid' and date='$date' and entity='$entity' and operation='$operation';";
$result = execSQL($con, $sql);
if($result == 0)
{
$sql="select count(1) from " . DBINFO::$COMMONDBNAME . ".appsqlmonitorlog where appid='$appid' and date='$date' and entity='$entity' and operation='$operation';";
$resultset = getResultArray($con, $sql);	
if(!$resultset[0][0] > 0){
$sql="insert into " . DBINFO::$COMMONDBNAME . ".appsqlmonitorlog values('$appid','$date','$entity','$operation','$sqlcount')";		
$result = execSQL($con, $sql);
}
}
}
function getReferenceDetailsFromSession($con,$formname,$fieldname,$refformname){
if(isset($GLOBALS [getAppId().'_form_reference_details'])){
$resultarray=$GLOBALS [getAppId().'_form_reference_details'];	
}else{
$sql="select ffr.formname,fieldname,refmodulename,refformname,reffieldname,frt.nthinstance, frt.relation, frt.indirectform, frt.relationid,frt.iseditable,frt.multisubtablenames,ff.type from formfieldreference ffr left join formrelationtable frt on ffr.relationid=frt.relationid left join formfieldtable ff on ff.formname = ffr.refformname and ffr.reffieldname = ff.name order by ffr.modulename,ffr.formname,fieldname;";
$resultarray = getResultArray($con, $sql);
$GLOBALS [getAppId().'_form_reference_details']=$resultarray;	
}
$dbrows=array();
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $formname && $resultset[1] == $fieldname && ($refformname == "" || $resultset[3] != $refformname)){
$row=array();	
for($si=2;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
return $dbrows;
}
function searchRefFormnameFromSession($con, $formname, $reffieldname){ 
if(isset($GLOBALS [getAppId().'_form_reference_name_details'])){
$resultarray=$GLOBALS [getAppId().'_form_reference_name_details'];	
}else{
$sql="select formname,reffieldname,refformname from formfieldreference order by formname,reffieldname";
$resultarray = getResultArray($con, $sql);
$GLOBALS [getAppId().'_form_reference_name_details']=$resultarray;	
}
$dbrows=array();
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $formname && $resultset[1] == $reffieldname){
$row=array();	
for($si=2;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
return $dbrows;	
}
function getRelationDetailForFieldFromSession($con, $formname, $fieldname){
if(isset($GLOBALS [getAppId().'_field_reference_relation_details'])){
$resultarray=$GLOBALS [getAppId().'_field_reference_relation_details'];	
}else{
$sql="select formname,name,nthinstance, relation, indirectform, fft.relationid from formfieldtable  fft left join formrelationtable frt on fft.relationid= frt.relationid where fft.type in('reference','form_history','entity_group','reference_group') and nthinstance is not NULL and name not in('createdon','updatedon','viewedon') order by formname,name";
$resultarray = getResultArray($con, $sql);
$GLOBALS [getAppId().'_field_reference_relation_details']=$resultarray;	
}
$dbrows=array();
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $formname && $resultset[1] == $fieldname){
$row=array();	
for($si=2;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
return $dbrows;		
}
function getFormTypeFromSession($con, $formname){
if(isset($GLOBALS [getAppId().'_form_type_details'])){
$resultarray=$GLOBALS [getAppId().'_form_type_details'];	
}else{
$sql="select formtype from formtable";
$resultarray = getResultArray($con, $sql);
$GLOBALS [getAppId().'_form_type_details']=$resultarray;	
}
$dbrows=array();
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $formname){
$row=array();	
for($si=0;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
return $dbrows;		
}
function getFormFieldTypeFromSession($con, $formname, $fieldname){
$dbrows=array();
if($formname != ""){
$sessionkey=getAppId()."_".$formname.'_field_type_details';
if(isset($GLOBALS [$sessionkey])){
$resultarray=$GLOBALS [$sessionkey];	
}else{
$sql="select name,type from formfieldtable where formname='$formname'";
$resultarray = getResultArray($con, $sql);
$GLOBALS [$sessionkey]=$resultarray;	
}

for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $fieldname){
$row=array();	
for($si=1;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
}
return $dbrows;	
}
function getFieldLabelNameFromSession($con, $fname, $ffname){
$dbrows=array();
if($fname != ""){
$sessionkey=getAppId()."_".$fname.'_field_label_details';
if(isset($GLOBALS [$sessionkey])){
$resultarray=$GLOBALS [$sessionkey];	
}else{
$sql="select name,label from formfieldtable where formname='$fname'";
$resultarray = getResultArray($con, $sql);
$GLOBALS [$sessionkey]=$resultarray;	
}
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $ffname){
$row=array();	
for($si=1;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
}
return $dbrows;		
}
function getFormProfileActionsFromSession($con,$formname,$rolename){
$dbrows=array();
if($formname != ""){
$sessionkey=getAppId().'_profile_form_action_details';
if(isset($GLOBALS [$sessionkey])){
$resultarray=$GLOBALS [$sessionkey];	
}else{
$sql="select formname,rolename,actions from table_2_frmaction order by formname,rolename";
$resultarray = getResultArray($con, $sql);
$GLOBALS [$sessionkey]=$resultarray;	
}
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $formname && $resultset[1] == $rolename){
$row=array();	
for($si=2;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
}
return $dbrows;	
}
function getFormProfileFieldsFromSession($con,$formname,$rolename){
$dbrows=array();
if($formname != ""){
$sessionkey=getAppId().'_profile_form_field_details';
if(isset($GLOBALS [$sessionkey])){
$resultarray=$GLOBALS [$sessionkey];	
}else{
$sql="select formname,rolename,fields from table_2_frmfields order by formname,rolename";
$resultarray = getResultArray($con, $sql);
$GLOBALS [$sessionkey]=$resultarray;	
}
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $formname && $resultset[1] == $rolename){
$row=array();	
for($si=2;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
}
return $dbrows;	
}
function getSuperAdminScreensFromSession($con,$formname){
$dbrows=array();
if($formname != ""){
$sessionkey=getAppId().'_super_admin_screens';
if(isset($GLOBALS [$sessionkey])){
$resultarray=$GLOBALS [$sessionkey];	
}else{
$sql="select SUBSTRING_INDEX(formname, ',', 1) from table_2_frmscreen where rolename='".UserDetails::$SUPER_ADMIN_PROFILE_NAME."'";
$resultarray = getResultArray($con, $sql);
$GLOBALS [$sessionkey]=$resultarray;	
}
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $formname){
$row=array();	
for($si=0;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
}
return $dbrows;	
}
function getFAFDetailsFromSession($con,$formname,$fieldname){
$dbrows=array();
if($formname != ""){
$sessionkey=getAppId().'_fetch_all_filter_details';
if(isset($GLOBALS [$sessionkey])){
$resultarray=$GLOBALS [$sessionkey];	
}else{
$sql="select * from fetchallfilterreference order by formname,fieldname";
$resultarray = getResultArray($con, $sql);
$GLOBALS [$sessionkey]=$resultarray;	
}
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $formname && $resultset[1] == $fieldname){
$row=array();	
for($si=0;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
}
return $dbrows;		
}
function getPickListDetailsByNameFromSession($con){
	if(isset($GLOBALS [getAppId()."_get_picklist_details"])){
	return $GLOBALS [getAppId()."_get_picklist_details"];	
	}else{
	$picklistmap=array();
	$sql="select name,itemname from picklisttable order by name,itemorder;";
	$resultarray = getResultArray($con, $sql);
	for($pi=0;$pi<sizeof($resultarray);$pi++){
		$pickname=$resultarray[$pi][0];
		$pickitem=$resultarray[$pi][1];
		if(isset($picklistmap[$pickname])){
		$picktempitemarr=$picklistmap[$pickname];
		$picktempitemarr[]=$pickitem;
		$picklistmap[$pickname]=$picktempitemarr;	
		}else{
		$pickitemarr=array();
		$pickitemarr[]=$pickitem;
		$picklistmap[$pickname]=$pickitemarr;	
		}		
	}
	$GLOBALS [getAppId()."_get_picklist_details"]=$picklistmap;
	return $picklistmap;
	}	
}
function getTriggerConditionFromSession($con, $triggerid){
$dbrows=array();
$sessionkey=getAppId().'_form_trigger_condition_details';
if(isset($GLOBALS [$sessionkey])){
$resultarray=$GLOBALS [$sessionkey];	
}else{
$sql="select tc.triggerid, nt.formname,nt.conditiontxt,nt.subtablename,nt.issubtable from newconditiontable nt, triggerconditiontable tc where nt.conditionid = tc.conditionid;";
$resultarray = getResultArray($con, $sql);
$GLOBALS [$sessionkey]=$resultarray;	
}
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $triggerid){
$row=array();	
for($si=1;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
return $dbrows;		
}
function getTriggerSystemActionFromSession($con, $triggerid){
$dbrows=array();
$sessionkey=getAppId().'_form_trigger_system_action_details';
if(isset($GLOBALS [$sessionkey])){
$resultarray=$GLOBALS [$sessionkey];	
}else{
$sql="select ts.triggerid,ns.formname,ns.feorbeaction, ns.typeofaction,ns.actiontxt,ns.status,ns.templatename from newsystemactiontable ns,triggersystemactiontable ts where ns.systemactionid = ts.systemactionid and ns.feorbeaction=0;";
$resultarray = getResultArray($con, $sql);
$GLOBALS [$sessionkey]=$resultarray;	
}
for($ri=0;$ri<sizeof($resultarray);$ri++){
$resultset=$resultarray[$ri];
if($resultset[0] == $triggerid){
$row=array();	
for($si=1;$si<sizeof($resultset);$si++){
$row[]=$resultset[$si];	
}
$dbrows[]=$row;	
break;
}
}
return $dbrows;	
}
function getDefaultValueByFormandFieldName($con,$formname,$fieldname){
$sessionkey=getAppId()."_".$formname."_".$fieldname.'_field_default_value';
$defaultvalue="";
if(isset($GLOBALS [$sessionkey])){
$defaultvalue=$GLOBALS [$sessionkey];	
}else{
$sql="select defaultvalue from formfieldtable where formname='$formname' and name='$fieldname';";
$resultarray = getResultArray($con, $sql);
$defaultvalue=$resultarray[0][0];
$GLOBALS [$sessionkey]=$defaultvalue;	
}
return $defaultvalue;	
}
function updateFormModificationHistoryDetails($con, $formname) {
	$currenttime = date ( 'Y-m-d H:i:s' );
	$sql = "select * from formwisemodifiedddetails where formname='$formname'";
	$resarr = getResultArray ( $con, $sql );
	if (sizeof ( $resarr ) == 0) {
		$sql = "insert into formwisemodifiedddetails values('$formname','$currenttime')";
		execSQL ( $con, $sql );
	} else {
		$sql = "update formwisemodifiedddetails set updated_time='$currenttime' where formname='$formname'";
		$result = execSQL ( $con, $sql );
	}
}
function getLocationFromLatitudeAndLongitude($con,$lat, $lng) {
	$apikey=choosegoogleapikey($con);
	$address="";
	if($apikey != ""){
    $url='https://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim ( $lat ) . ',' . trim ( $lng ) . '&key='.$apikey;
//	$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim ( $lat ) . ',' . trim ( $lng ) . '&sensor=false';
	$json = @file_get_contents ( $url );
	$data = json_decode ( $json );
	$status = $data->status;
	if ($status == "OK") {
		$address = $data->results [0]->formatted_address;
	}
	$sql="update ". DBINFO::$APPDBNAME .".googleapikeydetails set usedcount=usedcount+1 where apikey='$apikey'";	
	$result = execSQL ( $con, $sql );
	}
	return $address;
}
function choosegoogleapikey($con){
$currentdate=date ( 'Y-m-d' );
$sql="select * from ". DBINFO::$APPDBNAME .".googleapikeydetails where useddate='$currentdate';";
$resarr = getResultArray ( $con, $sql );
if(sizeof($resarr) == 0){
$sql="update ". DBINFO::$APPDBNAME .".googleapikeydetails set usedcount=0,useddate='$currentdate'";	
$result = execSQL ( $con, $sql );
}
$sql="select apikey from ". DBINFO::$APPDBNAME .".googleapikeydetails where usedcount < 2500;";	
$resarr = getResultArray ( $con, $sql );
if(sizeof($resarr) > 0){
return $resarr[0][0];	
}else{
return "";
}
}
function utf8_converter($array) {
	array_walk_recursive ( $array, function (&$item, $key) {
		if (! mb_detect_encoding ( $item, 'utf-8', true )) {
			$item = utf8_encode ( $item );
		}
	} );
	return $array;
}
function splitTextbyDelimiter($delimiter,$string,$firstoccuranceonly){
$splitarr=array();
$splittemparr = explode ( $delimiter, $string );
if($firstoccuranceonly){
$splitarr[]=$splittemparr[0];
$balancestr="";
for($si=1;$si<sizeof($splittemparr);$si++){
$balancestr.=$splittemparr[$si].$delimiter;		
}
if($balancestr != ""){
$balancestr=lastchartrim($balancestr);
$splitarr[]=$balancestr;	
}	
}else{
$splitarr=$splittemparr;
}
return $splitarr;
}
function getSMSCreditDetails($con,$obj){
$sql = "select total_sms_count,actual_sms_count from licenseinfo";
$result = getResultArray($con, $sql);
$response=array();
$response[]=$result[0][0];
$response[]=$result[0][1];
return $response;	
}
function saveVideoSettingsByUser($con, $obj) {
	$response = '';
	$username = getUserName ();
	try {
		$property="video";
		startTransaction ( $con );
		$sql = 'select * from user_preference where property=' . '\''.$property.'\'' . ' and username=' . '\'' . $username . '\'';
		$response = getResultArray ( $con, $sql );
		if ((sizeof ( $response )) === 0) {
			$sql = 'insert into user_preference values(' . '\'' . $username . '\'' . ',' . '\'' . $property . '\'' . ',' . '\'' . 'No' . '\'' . ')';
		} else {
			$sql = 'update user_preference set value=' . '\'' . 'No' . '\'' . ' where property=' . '\'' . $property . '\'' . ' and username=' . '\'' . $username . '\'';
		}
		execSQL ( $con, $sql );	
		commitTransaction ( $con );
	} catch ( Exception $e ) {
		rollbackTransaction ( $con );
		displaylogmsg ( 'Exception : ' . $e );
		$response = 'Error';
	}
	return $response;
}
function findMatchesByStringDiff($from_text,$to_text){
// limit input
//$from_text = substr($from_text, 0, 1024 * 100);
//$to_text = substr($to_text, 0, 1024 * 100);

$from_text= keyWordReplace($from_text);
$to_text= keyWordReplace($to_text);

if ((function_exists("get_magic_quotes_gpc") && get_magic_quotes_gpc()) || (ini_get('magic_quotes_sybase') && strtolower(ini_get('magic_quotes_sybase')) != "off")) {
	$from_text = stripslashes_deep($from_text);
	$to_text = stripslashes_deep($to_text);
}
// ensure input is suitable for diff
$from_text = mb_convert_encoding($from_text, 'HTML-ENTITIES', 'UTF-8');
$to_text = mb_convert_encoding($to_text, 'HTML-ENTITIES', 'UTF-8');
$granularityStacks = array(FineDiff::$paragraphGranularity, FineDiff::$sentenceGranularity, FineDiff::$wordGranularity, FineDiff::$characterGranularity);
$diff_opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, $granularityStacks[2]);
//set word granularity
$rendered_diff = FineDiff::renderDiffToHTMLFromOpcodes($from_text, $diff_opcodes);
$parseddataarr = getParsedDatafromRenderedDiff($rendered_diff);
$response=array();
$response[]=$parseddataarr[0];
$response[]=$parseddataarr[1];
return $response;
}
function stripslashes_deep(&$value){
	$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
	return $value;
}
function getParsedDatafromRenderedDiff($rendered_diff) {
	//echo $rendered_diff;
	$DOM = new DOMDocument;
	$DOM -> loadHTML($rendered_diff);
	$parseddata = array();
	$inselements = array();
	$delelements = array();
	$offset = 1;
	foreach ($DOM->getElementsByTagName('*') as $element) {
		if ($element -> tagName == 'ins' || $element -> tagName == 'del') {
			if ($offset % 2 == 0 && $element -> tagName == 'ins') {
				$value=$element -> nodeValue;
				$value=ltrim($value);
				$value=rtrim($value);
				$inselements[] =$value ;
				$offset++;
			} else if ($offset % 2 != 0 && $element -> tagName == 'del') {
				$value=$element -> nodeValue;
				$value=ltrim($value);
				$value=rtrim($value);
				$delelements[] = $value;
				$offset++;
			}
		}
	}
	$parseddata[] = $inselements;
	$parseddata[] = $delelements;
	return $parseddata;
}
function keyWordReplace($content){
$content= str_replace ( "'", " ' ",$content );
$content= str_replace ( '"', ' " ',$content );
$content= str_replace ( ",", " , ",$content );
$content= str_replace ( ".", " . ",$content );
$content= str_replace ( ":", " : ",$content );
$content= str_replace ( ";", " ; ",$content );
$content= str_replace ( ">", " > ",$content );
$content= str_replace ( "<", " < ",$content );
$content= str_replace ( "\r", "\n",$content );
$content= str_replace ( "\n", "\n\t<dummytext>\t",$content );
return $content;	
}
function removeSpecialCharaterSpace($content){
$content= str_replace ( " ' ", "'",$content );
$content= str_replace ( ' " ', '"',$content );
$content= str_replace ( " , ", ",",$content );
$content= str_replace ( " . ", ".",$content );
$content= str_replace ( " : ", ":",$content );
$content= str_replace ( " ; ", ";",$content );
$content= str_replace ( " > ", ">",$content );
$content= str_replace ( " < ", "<",$content );
$content= str_replace ( "\n\t<dummytext>\t", "",$content );
$content= str_replace ( "\n\t<dummytext>", "",$content );
$content= str_replace ( "\t<dummytext>\t", "",$content );
$content= str_replace ( "<dummytext>", "",$content );
return $content;	
}
function putAlertMailLog($con,$entityname){
$sql="create table if not exists alertmailmonitor (
  `entityname` varchar(200) not null,
  primary key (`entityname`));";
execSQL ( $con, $sql );	
$sql="insert into alertmailmonitor values('$entityname')";
execSQL ( $con, $sql );
}
function clearAlertMailLog($con,$entityname){
$sql="create table if not exists alertmailmonitor (
  `entityname` varchar(200) not null,
  primary key (`entityname`));";
execSQL ( $con, $sql );	
$sql="delete from alertmailmonitor where entityname='$entityname'";
execSQL ( $con, $sql );
}
function isValidAlertMail($con,$entityname){
$sql="create table if not exists alertmailmonitor (
  `entityname` varchar(200) not null,
  primary key (`entityname`));";
execSQL ( $con, $sql );	
$sql="select * from alertmailmonitor where entityname='$entityname'";
$response = getResultArray ( $con, $sql );
if(sizeof($response) > 0)
{
return false;	
}else {
return true;
}
}
function sendAutoTriggerAlertMail($appid){
$emailids=array();
$emailids[]="support@cratio.com";
$content="Auto Trigger Stopped to this appid:$appid upto end of this day due to AWS RDS Daily Quota(1 Lakh Transaction) Exceeded.";
$response=smtpmail ( $emailids, "Auto Trigger Alert:$appid", $content, "", "", false, "", "" );
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function extract_email_address ($string) {
   $emails = array();
  $string = str_replace("\r\n"," ",$string);
  $string = str_replace("\n"," ",$string);
$string = str_replace("\t"," ",$string);
$string = str_replace("<"," ",$string); 
$string = str_replace(">"," ",$string); 
   foreach(preg_split('/ /', $string) as $token) {
        $email = filter_var($token, FILTER_VALIDATE_EMAIL);
        if ($email !== false) { 
            $emails[] = $email;
        }
    }
    return $emails;
}
function extract_mobile_numbers($string){ 
$string = str_replace("\r\n",' ',$string);
$string = str_replace("\n",' ',$string);
$mobilepattern='/[\+]?\d{12}|[\+]?\d{10}|[\+]?\d{3}\s?-\d{8}|\(\d{3}\)\s?-\d{8}|\(\d{3}\)\s?-\d{6}|\b[0-9]{3}\s*[-]?\s*[0-9]{3}\s*[-]?\s*[0-9]{4}\b|\b[0-9]{3}\s*[-]?\s*[0-9]{4}\s*[-]?\s*[0-9]{4}\b/';
preg_match_all($mobilepattern,$string,$mobilenumbers);
return $mobilenumbers;
}

function isspecialCharacterAvailable($string){
	return preg_match("/[A-Za-z_~\!@#\$%\^&\*\(\)]$/", $string);
}

function updateInboundEmailConfig($con,$emailid,$appid){
$emailid=preg_replace('/[^A-Za-z0-9\-]/', '', $emailid);
$tempemailid=$emailid;
$isexists=true;
while($isexists){
$sql="select * from ". DBINFO::$APPDBNAME .".appmailboxdetails where mailbox='$tempemailid'";
$result = getResultArray($con, $sql);	
if(sizeof($result) == 0){
$isexists=false;	
}else{
$tempemailid=$emailid.mt_rand(1,5000);	
}
}
$sql="update emailscantable set servername='$tempemailid'";
execSQL ( $con, $sql );
$sql="insert into ". DBINFO::$APPDBNAME .".appmailboxdetails values('$appid','$tempemailid');";	
execSQL ( $con, $sql );
}
function getAppTempfilepath($appid){
 $basepath=getFolderbase ();
 if (! EndsWith ( $basepath, DIRECTORY_SEPARATOR )) {
$basepath .= DIRECTORY_SEPARATOR;
}
 if (!file_exists($basepath . "Content/$appid")) {
        mkdir($basepath . "Content/$appid");
        mkdir($basepath . "Content/$appid/tmp");
    } else if (!file_exists($basepath . "Content/$appid/tmp")) {
        mkdir($basepath . "Content/$appid/tmp");
    }
$basepath=$basepath . "Content/$appid/tmp/";
return $basepath;
}
function replaceSpecial($str) {
    $chunked = str_split($str, 1);
    $str = "";
    foreach ($chunked as $chunk) {
        $num = ord($chunk);
        // Remove non-ascii & non html characters
        if ($num >= 32 && $num <= 123) {
            $str.=$chunk;
        } else {
            $str.="&nbsp;";
        }
    }
return $str;
}

function checkValidUsermail($con,$emailid){
	if(strpos ( $emailid, ',' )){
		return true;
	}
	$usql = "select Alternate_contact_number from table_6_frm where emailid = '$emailid'";
	$emailverify = getResultArray($con, $usql);
	if (sizeof($emailverify) > 0) {
		if($emailverify[0][0] != "1"){
			return false;
		} else {
			return true;
		}
	} else {
		return true;
	}
}



?>