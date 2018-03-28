<?php
function getAppEmailConfiguration($appid,$isBulkMail) {
	$saasconn = new PDOConnection("");
    if ($saasconn) {
    	$con = $saasconn->getConnection();
        if ($con == null) {
            throw new Exception($saasconn->getDBErrorMsg());
        }
    } else {
        throw new Exception("Not able to connect to DB");
    }
	$sql="";
    if ($appid != '') {
        if (isset($GLOBALS[$appid . "_f11"])) {
            $id = $GLOBALS[$appid . "_f11"];
        } else {
            $sql = 'select f11 from  ' . DBINFO::$APPDBNAME . '.applicationlist where appid=' . '\'' . $appid . '\'';
            $resultrows = getResultArray($con, $sql);
            $id = $resultrows[0][0];
            $GLOBALS[$appid . "_f11"] = $id;
        }
        $sql = 'select * from  ' . DBINFO::$APPDBNAME . '.emailconfig where table_id=' . '\'' . $id . '\'';
    } else {
        $sql = 'select * from  ' . DBINFO::$APPDBNAME . '.emailconfig where isdefault=1';
    }	
	$emailconfigarray=array();
	if($isBulkMail){
		if (isset($GLOBALS[$appid . "bulkmailconfig"])) {
        $emailconfigarray = $GLOBALS[$appid . "bulkmailconfig"];
        } else {        
		$bulkmailsql="select * from " .DBINFO::$APPDBNAME.$appid. ".appmassemailconfig";
		$bulkmailconfigarray = getResultArray($con, $bulkmailsql);
		if(sizeof($bulkmailconfigarray) == 0){		
		$bulkmailconfigarray = getResultArray($con, $sql);
		}
		$emailconfigarray=$bulkmailconfigarray;
        $GLOBALS[$appid . "bulkmailconfig"] = $emailconfigarray;
    }
	} else{
	if (isset($GLOBALS[$appid . "mailconfig"])) {
        $emailconfigarray = $GLOBALS[$appid . "mailconfig"];
    } else {
    	if($appid != ""){
    	$mailconfigsql="select * from " .DBINFO::$APPDBNAME.$appid. ".appemailconfig";
		$emailconfigarray = getResultArray($con, $mailconfigsql);	
    	}    	
		if(sizeof($emailconfigarray) == 0){		
		 $emailconfigarray = getResultArray($con, $sql);
		}	
        $GLOBALS[$appid . "mailconfig"] = $emailconfigarray;
    }
	}     
	      if($appid != ""){
		    $sendernameindex = 11;
	        $sendermailid=$emailconfigarray [0] [10];
			if(strpos($sendermailid, "@cratio.com") > 0){			
			$dbname = DBINFO::$APPDBNAME . $appid;
		    $sql = "select Organization_Name from " . $dbname . ".table_21_frm ";
			$orgarr = getResultArray ( $con, $sql );
			if (sizeof ( $orgarr ) > 0) {				
				$emailconfigarray [0] [$sendernameindex] = $orgarr [0] [0];
			}	
			}
	        }
	        
	return $emailconfigarray;
}
function smtpmail($toaddrs, $subject, $body, $rsendername, $attachment, $ismulti, $appid, $rsenderemailid,$deleteattachment=true,$isBulkMail=false) {
	// ini_set('display_errors', 1);
	// error_reporting(E_ALL);
	$emailconfigarray = getAppEmailConfiguration ($appid,$isBulkMail);
	// $xml = simplexml_load_file(getcwd() . "/mail.xml");
	// $variable = $xml->mailfunc;
	$mailfunc_index = 4;
	$servername_index = 3;
	$protocal_index = 6;
	$mailid_index = 8;
	$password_index = 9;
	$portno_index = 5;
	$dbfilename_index = 7;
	$fromaddress_index = 10;
	$sendername_index = 11;
	$variable = $emailconfigarray [0] [$mailfunc_index];
	if ($variable == 'lotus') {
		$servername = $xml->servername;
		$dbfilename = $xml->filename;
		$password = $xml->password;
		$session = new COM ( "Lotus.NotesSession" ) or die ( "Can't init Notes Session" );
		$session->Initialize ( $password );
		$db = $session->GetDatabase ( $servername, $dbfilename );
		$doc = $db->CreateDocument ();
		$doc->ReplaceItemValue ( "Form", "Memo" );
		$emailds = "";
		$esize = sizeof ( $toaddrs );
		for($ei = 0; $ei < $esize; $ei ++) {
			$emailids .= $toaddrs [$ei] . ",";
		}
		lastchartrim ( $emailids );
		$doc->ReplaceItemValue ( "SendTo", $emailids );
		$doc->ReplaceItemValue ( "Subject", $subject );
		$ritem = $doc->CreateRichTextItem ( "Body" );
		$ritem->AppendText ( $body );
		$doc->Send ( False );
		return $doc;
	} else if ($variable == 'gsmtp') {
		require_once ("phpgmailer/class.phpmailer.php");
		require_once ('phpgmailer/class.phpgmailer.php');
		$servername = $xml->servername;
		$dbfilename = $xml->filename;
		$password = $xml->password;
		$mailid = $xml->mailid;
		$portno = $xml->portnumber;
		if ($sendername == '')
			$sendername = $xml->sendername;
		$mail = new PHPGMailer ();
		$mail->Username = $mailid;
		$mail->Password = $password;
		$mail->From = $mailid;
		$mail->FromName = $sendername;
		$mail->Subject = $subject;
		$esize = sizeof ( $toaddrs );
		for($ei = 0; $ei < $esize; $ei ++) {
			$mail->AddAddress ( $toaddrs [$ei] );
		}
		$mail->Body = $body;
		$mail->host = $servername;
		$mail->port = $portno;
		$res = $mail->Send ();
		return $res;
	} else if ($variable == 'smtp') {
		require_once ("phpmailer/class.phpmailer.php");
		// $protocal = $xml->protocal;
		// $servername = $xml->servername;
		// $mailid = $xml->username;
		// $password = $xml->password;
		// $portno = $xml->portnumber;
		// $dbfilename = $xml->filename;
		// $fromaddress = $xml->fromaddress;
		// if ($sendername == '')
		// $sendername = $xml->sendername;
		$protocal = $emailconfigarray [0] [$protocal_index];
		$servername = $emailconfigarray [0] [$servername_index];
		$mailid = $emailconfigarray [0] [$mailid_index];
		$password = $emailconfigarray [0] [$password_index];
		$portno = $emailconfigarray [0] [$portno_index];
		$dbfilename = $emailconfigarray [0] [$dbfilename_index];
		$fromaddress = $emailconfigarray [0] [$fromaddress_index];
		$fsenderename = $emailconfigarray [0] [$sendername_index];
		if($rsendername != ''){
		$fsenderename=$rsendername;
		}
		if ($rsenderemailid == '')
			$rsenderemailid = $fromaddress;
		if ($rsendername == '')
			$rsendername = $fsenderename;
		$mailer = new PHPMailer ();
		$mailer->IsSMTP ();
		$host="$protocal://$servername:$portno";
		if(strpos($servername, "sparkpostmail.com") > 0 || $portno == "25"){
		$host="$servername:$portno";	
		}
		$mailer->Host = $host;
		$mailer->SMTPAuth = TRUE;
		$mailer->Username = $mailid; // Change this to your gmail adress
		$mailer->Password = $password; // Change this to your gmail password
		$mailer->From = $fromaddress; // This HAVE TO be your gmail adress
		$mailer->FromName = $fsenderename; // This is the from name in the email, you can put anything you like here
		$mailer->AddReplyTo ( "$rsenderemailid", "$rsendername" );
		$mailer->IsHTML ( true );
		$mailer->Body = $body;
		$mailer->Subject = $subject;
		for($i = 0; $i < sizeof ( $attachment ); $i ++) {			
			$filename = basename ( $attachment [$i] );			
			$path = getFolderbase ();			
			if (trim ( $filename ) != "") {
				if (strpos ( $attachment [$i], "table_" ) && string_begins_with ( trim ( $attachment [$i] ), DIRECTORY_SEPARATOR )) {
					if(strpos($attachment [$i], "/www/")){
					$path = $attachment [$i];	
					}else{
					$path = lastchartrim($path). $attachment [$i];	
					}										
				} else if (string_begins_with ( trim ( $attachment [$i] ), $path )) {
					$path = $attachment [$i];
				} else {
					if (! EndsWith ( $path, DIRECTORY_SEPARATOR )) {
						$path .= DIRECTORY_SEPARATOR . "Content" . DIRECTORY_SEPARATOR;
					} else {
						$path .= "Content" . DIRECTORY_SEPARATOR;
					}
					$appid = getAppid ();
					if ($appid != '') {
						$path = $path . $appid . DIRECTORY_SEPARATOR;
					}
					$path = $path . "tmp" . DIRECTORY_SEPARATOR . $filename;
				}					
				$attachment [$i]=$path;	
			//	debug(">>>>Attachment path>>>>".$path);	
				//debug(">>>>Attachment File>>>>".$filename);	
				$mailer->AddAttachment ( trim ( $path ), trim ( $filename ) );
			}
		}
		$esize = sizeof ( $toaddrs );
		// $toaddressval = explode(",", $toaddrs);
		if ($ismulti) {
			$tostr = $toaddrs [0];
			$toaddressval = explode ( ",", $tostr );
			$ccstr = $toaddrs [1];
			$ccaddressval = explode ( ",", $ccstr );
			$bccstr = $toaddrs [2];
			$bccaddressval = explode ( ",", $bccstr );
			for($ei = 0; $ei < sizeof ( $toaddressval ); $ei ++) {
				if ($toaddressval [$ei] != "")
					$mailer->AddAddress ( $toaddressval [$ei] );
			}
			for($ei = 0; $ei < sizeof ( $ccaddressval ); $ei ++) {
				if ($ccaddressval [$ei] != "")
					$mailer->AddCC ( $ccaddressval [$ei] );
			}
			for($ei = 0; $ei < sizeof ( $bccaddressval ); $ei ++) {
				if ($bccaddressval [$ei] != "")
					$mailer->AddBCC ( $bccaddressval [$ei] );
			}
		} else {
			for($ei = 0; $ei < $esize; $ei ++) {
				$tostr = $toaddrs [$ei];
				$toaddressval = explode ( ",", $tostr );
				for($ti = 0; $ti < sizeof ( $toaddressval ); $ti ++) {
					if ($toaddressval [$ti] != "")
						$mailer->AddAddress ( $toaddressval [$ti] );
				}
			}
		}
		//debug(">>>Before Sent>>>>>>".$res);
		$res =$mailer->Send ();
		//debug(">>>After Sent>>>>>>".$res);
		if ($res) {
			if($deleteattachment){
				for($i = 0; $i < sizeof ( $attachment ); $i ++) {
				$filepath = $attachment [$i];	
				//debug(">>>>>Unlink File path>>>>".$filepath);			
				if (file_exists ( $filepath ) && !strpos ($filepath, "table_" )) {
					$old = umask ( 0 );
					unlink ( $filepath );
					umask ( $old );
				}
			}	
			}		
			if (strpos ( $servername, 'amazonaws.com' ) !== 0) { // first 6 letter is for status code and ok string,remaining is for messageid
				$res = $mailer->getSuccessResponse ();
				$res = "messageid:" . substr ( $res, 6, strlen ( $res ) );
			}
		} else {
			$res = "Error:" . $mailer->getErrorResponse ();
		}
		//debug(">>>Response Sent>>>>>>".$res);
		return $res;
	}
}

?>
