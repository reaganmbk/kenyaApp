<?php
require_once 'smppclient.class.php';
require_once 'gsmencoder.class.php';
require_once 'sockettransport.class.php';
require_once 'KLogger.php';
date_default_timezone_set("Africa/Johannesburg");
define("LOG_FILE_PATH", "/var/log/mobi_campaigns/");
define("LOG_DATE", date("Y-m-d"));
$loggerObj = new KLogger (LOG_FILE_PATH."SMPP".LOG_DATE.".log", KLogger::DEBUG );
$loggerObj->LogInfo("Incoming request!!!!!!!");

$content = $_REQUEST['MSISDN'];

$loggerObj->LogInfo("MSISDN is".$content);


// Construct transport and client
$host = "172.17.105.30";
$port = "3710";
$phoneNumber = $content;
$sender = "SMPPTest";

$transport = new SocketTransport(array($host),$port);
$transport->setRecvTimeout(10000);
$loggerObj->LogInfo("===================== SMPP TRANSPORT ===========================");
$loggerObj->LogInfo(print_r($transport, true));
$smpp = new SmppClient($transport);
$loggerObj->LogInfo("===================== SMPP OBJECT ===========================");
$loggerObj->LogInfo(print_r($smpp, true));

// Activate binary hex-output of server interaction
$smpp->debug = true;
$transport->debug = true;

// Open the connection
$transport->open();
$smpp->bindTransmitter('adlib','HFSz2fHQ');

// Prepare message
$message = 'Hello Similo working toward UAT test 2nd test!';
$encodedMessage = GsmEncoder::utf8_to_gsm0338($message);
$from = new SmppAddress($sender,SMPP::TON_ALPHANUMERIC);
$to = new SmppAddress($phoneNumber,SMPP::TON_INTERNATIONAL,SMPP::NPI_E164);
$tags=null;
$loggerObj->LogInfo("MSISDN is".$phoneNumber);
// Send
$smpp->sendSMS($from,$to,$encodedMessage,$tags);
//$status = $smpp->queryStatus($messageid, $from);

// Close connection
$smpp->close();