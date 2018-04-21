<?php
ini_set ( "display_errors", "1" );
error_reporting ( E_ALL );
//$userresult = createSubuser();
//$uu = $userresult;
//$userresult = json_decode($userresult,true);
//$subusername = $userresult['username'];
//
//$apiresult = createAPI($subusername);
//$apiresult = json_decode($apiresult,true);

//$notiresult = updateEventnotificationURL($subusername);

define('SEND_GRID_API', "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");

function createSubuser($username, $email,$password){
    $data_array['username']=$username;
    $data_array['email']=$email;
    $data_array['password']=$password;
    $ipadd = array();
    $ipadd[] = "167.89.78.50";
    $data_array['ips']=$ipadd;
    $payload = json_encode($data_array);
    $ch = curl_init('https://api.sendgrid.com/v3/subusers');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer ".SEND_GRID_API,
    "content-type: application/json"
  	));

    $result = curl_exec($ch);
    $result = json_decode($result,true);
    if(isset($result['username']) && $result['username'] != ""){
        displaysignuplog("SendGrid Sub User Creation Success");
        return true;
    }else{
        displaysignuplog("SendGrid Sub User Creation Error".$result['error']);
        return false;
    }

}

function createAPI($subusername){
    $permissions = array();
    $permissions[] = 'mail.send';
    $permissions[] = 'alerts.create';
    $permissions[] = 'alerts.read';
    $data_array['name']='Default API Key';
    $data_array['scopes']=$permissions;
    $payload = json_encode($data_array);
    $ch = curl_init('https://api.sendgrid.com/v3/api_keys');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    'Content-Type: application/json',
	    'Content-Length: ' . strlen($payload),
        "Authorization: Bearer ".SEND_GRID_API,
	    'On-behalf-of: '.$subusername));
    $result = curl_exec($ch);
    $result = json_decode($result,true);
    if(isset($result['api_key']) && $result['api_key'] != ""){
        displaysignuplog("SendGrid Sub User API Creation Success");
        return $apikey=$result['api_key'];
    }else{
        displaysignuplog("SendGrid Sub User API Creation Failed:".$result['error']);
        return "";
    }

}

function updateEventnotificationURL($subusername,$url){
    $data_array['enabled']=true;
    $data_array['url']=$url;
    $data_array['bounce']=true;
    //$data_array['group_resubscribe']=true;
    //$data_array['delivered']=true;
    //$data_array['group_unsubscribe']=true;
    $data_array['spam_report']=true;
    //$data_array['deferred']=true;
    $data_array['unsubscribe']=true;
    //$data_array['processed']=true;
    //$data_array['open']=true;
    //$data_array['click']=true;
    //$data_array['dropped']=true;

    $payload = json_encode($data_array);
    $ch = curl_init('https://api.sendgrid.com/v3/user/webhooks/event/settings');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    'Content-Type: application/json',
	    'Content-Length: ' . strlen($payload),
        "Authorization: Bearer ".SEND_GRID_API,
        'On-behalf-of: '.$subusername));
    $result = curl_exec($ch);
    $result = json_decode($result,true);
    if(isset($result['bounce']) && $result['bounce']){
        displaysignuplog("SendGrid Sub User Event Notification updated Success");
        return true;
    }else{
        displaysignuplog("SendGrid Sub User Event Notification updated Failed:".$result['error']);
        return false;
    }
}

function updateWhiteLabelDomain($subusername){
    $data_array['username']=$subusername;
    $payload = json_encode($data_array);
    $ch = curl_init('https://api.sendgrid.com/v3/whitelabel/domains/1834397/subuser');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload),
        "Authorization: Bearer ".SEND_GRID_API,
    ));
    $result = curl_exec($ch);
    $result = json_decode($result,true);
    if(isset($result['id']) && $result['id'] != ""){
        displaysignuplog("SendGrid Sub User Changed Email Sending Success");
        return true;
    }else{
        displaysignuplog("SendGrid Sub User Changed Email Sending Failed:".$result['error']);
        return false;
    }
}

function updateWhiteLabelLink($subusername){
    $data_array['username']=$subusername;
    $payload = json_encode($data_array);
    $ch = curl_init('https://api.sendgrid.com/v3/whitelabel/links/903177/subuser');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload),
        "Authorization: Bearer ".SEND_GRID_API,
    ));
    $result = curl_exec($ch);
    $result = json_decode($result,true);
    if(isset($result['id']) && $result['id'] != ""){
        displaysignuplog("SendGrid Sub User Changed Email Tracking Success");
        return true;
    }else{
        displaysignuplog("SendGrid Sub User Changed Email Tracking Failed:".$result['error']);
        return false;
    }
}

function checkStatus($subusername){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/subusers?username=$subusername");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer ".SEND_GRID_API,
    ));
    $result = curl_exec($ch);
    $result = json_decode($result,true);
    if(isset($result[0]['disabled']) && !$result[0]['disabled']){
        //displaysignuplog("SendGrid Sub User Account is Enabled");
        return true;
    }else{
        //displaysignuplog("SendGrid Sub User Account is disabled:".$result['error']);
        return false;
    }
}
?>
