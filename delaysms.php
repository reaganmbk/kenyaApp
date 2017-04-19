<?php

require_once 'classes/kenyaClass.php';
require_once('classes/AfricasTalkingGateway.php');
$obj = New kenyaClass();


							//$sec = 45 ;
							// $cell_ = $_GET['msisdn'];
							// $dest_  = $_GET['msisdn2'];
							// global $loggerObj;
							// $username   = "versatel";
							// $apikey     = "bab675f3caa2a595f66bc3f669581c05929e962585e4470bb1b6f25a9be0a2db";


							//  $cell = substr($cell_,1);
		     //        		 $msisdn = "+254".$cell;

		     //        		 $mobi = substr($dest_,1);
		     //        		 $dest_msisdn = "+254".$mobi;



		     //        		 //Send SMS TO LEG A
		            		
		     //        		 $message = "Your call was sponsored by tuko.co.ke. Visit tuko.co.ke for breaking news.";
		            		
		            		

			    //         		 //Send SMS TO LEG B
			    //             $dest_msisdn= "+".$msisdn_2;
			    //             $message = "Your friend's call was FREE and sponsored by TUKO. You too can make a FREE call by dialing *384*11#.";
			    //         	$obj->sendSMStoLegB($username, $apikey, $dest_msisdn, $message);

			            	
							// $time = sleep(55);							 
							// if ($time == true ){

							//   }
				   //          // SEND SMS TO LEG B
			            		 
			    //            // $recipients = "+".$msisdn_2;
			    //         	$message    = "Your friend's call was FREE and sponsored by TUKO. You too can make a FREE call by dialing *384*11#.";
			    //         	$obj->sendSMStoLegA($username, $apikey, $msisdn, $message);
			    //         	$smslegB = sendSMSlegB($recipients, $message);
			            	
			    //         	$loggerObj->LogInfo( "SMS SENT TO LEG B AND LEG A" );
			    //             $loggerObj->LogInfo( "LEG A". $msisdn );
			    //             $loggerObj->LogInfo( "LEG B". $dest_msisdn);




 global $loggerObj;
 $loggerObj->LogInfo( "TESTING CRON SCRIPT WITH 5 Sec DElay");
 $loggerObj->LogInfo( "SMS SENT");


?>