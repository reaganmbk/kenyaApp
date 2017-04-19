<?php
require_once 'classes/kenyaClass.php';
require_once('classes/AfricasTalkingGateway.php');
$obj = New kenyaClass();
   


 $phoneNumber = $_POST['phoneNumber'];
 $shortCode = $_POST['shortCode'];
 $keyword = $_POST['keyword'];
 $updateType = $_POST['updateType'];

 global $loggerObj;
 $loggerObj->LogInfo("============= INCOMING PARAMETERS FROM SAFARICOM ===============");
 $loggerObj->LogInfo("MSISDN :" .  $phoneNumber ."|". "SHORT CODE :" .$shortCode."|". "KEYWORD :" .$keyword."|"."TYPE OF REQUEST :" .$updateType);

 $username   = "versatel";
 $apikey     = "bab675f3caa2a595f66bc3f669581c05929e962585e4470bb1b6f25a9be0a2db";


if (isset($phoneNumber) && isset($shortCode) && isset($keyword) && isset($updateType)){

 if($updateType == "Addition") {
  //Add phoneNumber to subscribers' list
  $obj->saveSubscriber($phoneNumber, $shortCode,  $keyword, $updateType);
  $message   = "Save time by dialing *384*11*phonenumber#. Please enter the number of the person you wish to call for free.";
  $obj->sendSMStoSubscriber($username, $apikey, $phoneNumber, $message);
  global $loggerObj;
  $loggerObj->LogInfo("============= SMS SENT ===============");
  $loggerObj->LogInfo("SMS SENT TO :" .  $phoneNumber);
  $obj->UpdateSubcsriber($phoneNumber);

 }
 elseif($updateType == "Deletion") {


//Remove phoneNumber from subscribers' list
   $obj->deleteSubscriber($phoneNumber);
  $message   = "You have unsubscribed from TUKO. We are sorry to see you go.";
  $obj->sendSMStoSubscriber($username, $apikey, $phoneNumber, $message);

  
 }

}

