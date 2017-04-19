<?php

require_once 'KLogger.php';
date_default_timezone_set("Africa/Johannesburg");
define("LOG_FILE_PATH", "/var/www/html/ussd/mobitainment/logs/");
define("LOG_DATE", date("Y-m-d"));
$loggerObj = new KLogger (LOG_FILE_PATH."KENYA_USSD".LOG_DATE.".log", KLogger::DEBUG );
$loggerObj->LogInfo("Incoming request for Kenya ussd !!!!!!!");

class ussdClass
{
		public function __construct()
		{
				//Connection to the database
				$this->pdoUSSD = new PDO('mysql:host=139.162.216.4; dbname=vcalldb', 'root', 'WaugEHDoDDAA');

		}

		// Store the ussd session into db
		
	public function newSession($sessionId, $phoneNumber, $serviceCode, $text)
		{
				$req = "INSERT INTO `campaign_stats` (`tracer_id`, `msisdn`, `message`, `dest_msisdn`, `session_start`, `session_end`, `call_initiated`, `status`,`service_id`) VALUES ('".$sessionId."', '".$phoneNumber."', '".$serviceCode."', '".$phoneNumber."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 0, 1, 0)";
                   
				$select = $this->pdoUSSD->prepare($req);
				$select->execute();
				$select->CloseCursor();
				//$this->updateHits($_GET['userdata']);
				//return $req;
	    }


public function rgm(){

echo "HELLOWORLD";

}
   
   // Check subscriber exists
         public function demo(){

         	return true;
         }

	    
	
}
