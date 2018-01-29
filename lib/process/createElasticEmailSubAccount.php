<?php
/**
 * Created by PhpStorm.
 * User: prabhu
 * Date: 25/1/18
 * Time: 5:57 PM
 */

function createSubAccount($email,$password){
    displaysignuplog("Elastic Sub Account Creation:$email");
    $status=[];
    $data_array['apikey']="16413240-2843-4bf7-b0d0-6ccbaa001521";
    $data_array['email']=$email;
    $data_array['password']=$password;
    $data_array['confirmPassword']=$password;
    $data_array['requiresEmailCredits']="true";
    $data_array['enableLitmusTest']="false";
    $data_array['requiresLitmusCredits']="false";
    $data_array['maxContacts']="10000";
    $data_array['enablePrivateIPRequest']="false";
    $data_array['sendActivation']="false";
    $data_array['sendingPermission']="All";
    $data_array['emailSizeLimit']="10";
    $data_array['dailySendLimit']="10000";
//die(http_build_query($data_array));
    $ch = curl_init('https://api.elasticemail.com/v2/account/addsubaccount');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_array));
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));
    $result = curl_exec($ch);
//echo $result;
    $presponse = json_decode($result, true);
    $apikey="";
    $apierror="";
    if(isset($presponse['success']) && $presponse['success']){
        displaysignuplog("Elastic Sub Account Creation Success");
        $apikey=$presponse['data'];
    }else{
        displaysignuplog("Elastic Sub Account Creation Failed:".$presponse['error']);
        $apierror=$presponse['error'];
    }
    $status[]= $apikey;
    $status[]= $apierror;

    return $status;
}

function updateHTTPNotification($apikey,$notifyurl){
    displaysignuplog("Elastic HTTP Notification Enabled:$notifyurl");
    $settings=[];
    $settings['sent']="false";
    $settings['opened']="false";
    $settings['clicked']="false";
    $settings['unsubscribed']="false";
    $settings['complaints']="true";
    $settings['error']="true";
    $settings_string = json_encode($settings);

    $data_array['apikey']=$apikey;
    $data_array['url']=$notifyurl;
    $data_array['notifyOncePerEmail']="true";
    $data_array['settings']=$settings_string;
   // die(http_build_query($data_array));
    $ch = curl_init('https://api.elasticemail.com/v2/account/updatehttpnotification');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_array));
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));
    $result = curl_exec($ch);
     //die($result);
    $presponse = json_decode($result, true);
    if(isset($presponse['success']) && $presponse['success']){
        displaysignuplog("Elastic HTTP Notification Enabled Successfully:$notifyurl");
        return true;
    }else{
        displaysignuplog("Elastic HTTP Notification Enabled Failed:$notifyurl");
        return false;
    }
}

?>