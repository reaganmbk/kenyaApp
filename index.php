<?php
#!/usr/bin/php

	require_once 'classes/kenyaClass.php';
	// require_once('classes/AfricasTalkingGateway.php');
	$obj = New kenyaClass();
	// $gateway    = new AfricasTalkingGateway($username, $apikey);

	//$obj->demo();

 	$sessionId   = $_POST["sessionId"];
    $serviceCode = $_POST["serviceCode"];
    $phoneNumber = $_POST["phoneNumber"];
    $text        = $_POST["text"];
    $checkoutToken = $_POST['checkoutToken'];


    $username   = "versatel";
	$apikey     = "bab675f3caa2a595f66bc3f669581c05929e962585e4470bb1b6f25a9be0a2db";



     // LOG INCOMING PARAMETERS FROM GATEWAY
     global $loggerObj;
     $loggerObj->LogInfo("============= KENYA TUKO QUIX CALL ===============");
     $loggerObj->LogInfo("============= RETRIEVING SDP PARAMETERS ===============");
     $loggerObj->LogInfo("LOG INCOMING PARAMETERS FROM GATEWAY");
     $loggerObj->LogInfo("SESSIONID :" . $sessionId ."|". "SERVICE CODE :" .$serviceCode ."|". "MSISDN :" .$phoneNumber ."|"."CHECK OUT TOKEN :" .$checkoutToken);


            
    // FORMAT THE MSISDN TO THE DISIRED

    $phonenumber = $phoneNumber;
    $cell = substr($phonenumber,4);
    $cellphone = "254".$cell;
    // LOG MSISDN IN DESIRED FORMAT
    // $loggerObj->LogInfo( "LOG MSISDN IN DESIRED FORMAT" );
    // $loggerObj->LogInfo( $cellphone );

    // FORMAT MSISDN 2 TO THE RIGHT FORMAT

    // $dest_msisdn = substr($text, 3);
    // $msisdn_2 = "254".$dest_msisdn;

     // LOG MSISDN 2 IN DESIRED FORMAT
   // $loggerObj->LogInfo( "LOG MSISDN 2 IN DESIRED FORMAT" );
    $loggerObj->LogInfo( $msisdn_2 );

    //Process levels
    $level = explode("*", $text);


    function curlHTTPRequest($url, $params, $http_header){
	        /* initialise curl resource */
	        $curl = curl_init();

	        /* result container, whether we are getting a feedback form url or an error */
	        $result = null;

	        $http_header_p = '';
	        $http_params = '';
	        $username = '';
	        $password = '';
	        /* determine the http_header */
	        if (is_string($http_header)){
	            if ($http_header == 'XML'){
	                $http_header_p = array('Content-Type: text/xml; charset=utf-8');
	                $http_params = $params;
	            } else if ($http_header == 'JSON'){
	                $http_params = json_encode($params[0], true);
	                $http_header_p = array(
	                    'Content-Type: application/json',
	                    'Content-Length: ' . strlen($http_params));
	                /* check if password is required */
	                if (isset($params['username']) && isset($params['password'])){
	                    $username = $params['username'];
	                    $password = $params['password'];
	                }
	            }
	        }


	        /* set resources options for GET REQUEST */
	            curl_setopt_array($curl, array(
	            CURLOPT_RETURNTRANSFER => 1,
	            CURLOPT_URL => $url,
	            CURLOPT_CONNECTTIMEOUT => 30000, //attempt a connection within 30sec
	            CURLOPT_FAILONERROR => 1,
	            CURLOPT_POST => 1,
	            CURLOPT_HTTPHEADER => $http_header_p,
	            CURLOPT_POSTFIELDS => $http_params,
	            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
	            CURLOPT_USERPWD => $username.":".$password
	        ));


	        /* execute curl */
	        $result = curl_exec($curl);

	        if(curl_error($curl)){
	            $result = 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
	        }
	        /* close request to clear up some memory */
	        curl_close($curl);

	        

	        /* return the result */
	        return $result;

	        // log curl

	        // $loggerObj->LogInfo( "LOG CURL RESULT" );
   		    // $loggerObj->LogInfo( print_r($result) );	        
	    }


	    /* initiate the call to AdVoice Api */
	    function start_AdVoiceCall($msisdn, $msisdn_2, $demo=null)
	    {
	      

	       // $loggerObj->LogInfo("======================== ADVOICE API STARTING CALL =======================");

	        $params = array(
	             'username' => 'Versatel',
	            'password' => '193jmgR)23',
	            array(
	                "contact" => $msisdn,
	                "status" => '1',
	                "additional_vars" => '{"transfer_phonenumber":"'.$msisdn_2.'"}',
	               // "phonebook" => 'http://129.232.209.250/rest-api/phonebook/907/'
	                'phonebook' => 'http://129.232.209.250/rest-api/phonebook/935/'
	            )
	        );

	        if ($demo) {
	            // $loggerObj->LogInfo(print_r($params[0], true));
	            // $loggerObj->LogInfo("======================== ADVOICE API RESPONSE =======================");
	            // $loggerObj->LogInfo("ADVOICE API - CALL INITIATED SUCCESSFULLY - DEMO ");
	            // $result = true;
	        } else {
	           // $loggerObj->LogInfo(print_r($params[0], true));
	            $curl = curlHTTPRequest('http://129.232.209.250/rest-api/contact/', $params, 'JSON');
	         //   $loggerObj->LogInfo("======================== ADVOICE API RESPONSE =======================");
	           // $loggerObj->LogInfo(print_r($curl, true));
	            /* check the return result */
	            if (!is_array($curl)){
	                if (strpos($curl, 'Error') !== false){
	                    $result = null;
	                } else {
	                    $result = true;
	                }
	            } else if (is_array($curl) && !empty($curl)) {
	                $result = $curl;
	            }

	        }
	        return $result;
	        // $loggerObj->LogInfo( "LOG CURL RESULT" );
   		    // $loggerObj->LogInfo( print_r($result) );
	    }  





                            // DELAY EXECUTION 45 MIN

	   						 function delay($cellphone, $msisdn_2)

	   						 {

	    	 				
													// Get cURL resource
							$curl = curl_init();
							// Set some options - we are passing in a useragent too here
							curl_setopt_array($curl, array(
							    CURLOPT_RETURNTRANSFER => 1,
							    CURLOPT_URL => 'http://139.162.223.21/ussd/kenyaApp/delaysms.php?msisdn=$cellphone&msisdn2=$msisdn_2',
							    CURLOPT_USERAGENT => 'cURL Request'
							));
							// Send the request & save response to $resp
							$resp = curl_exec($curl);
							// Close request to clear up some resources
							curl_close($curl);
	   							 
	   						}




     // Main if statement
	if (isset($text)) {

  		if ( $text == "")  
  		   {


  		   					// Check if subscribed 
  		   			$checkCall = $obj->checkMaxCall($cellphone);
  		   	        $checksubscriber = $obj->checkSubscriber($cellphone);

  		   	         if ($checkCall == TRUE){

      					 	 $response  = "END Sorry the daily offer of FREE calls has been reached. Please try again tomorrow.\n";
      					 }else

  		   				 if ($checksubscriber == TRUE)
  		   				 {  

          				  $response  = "END Save time by dialing *384*11*phonenumber#.\n";

      					 }

      					 else 

      					 {
  		   				// APP MAIN MENU
			             $response  = "CON Karibu! Subscribe for news alerts to make FREE calls:\n";
				         $response .= "1. News \n";
				         $response .= "2. Sports \n";
				         $response .= "3. Entertainment \n";
				         $response .= "4. Politics \n";
				         $response .= "5. Exit";

			         //Store the session
					
					 // $loggerObj->LogInfo( "SAVE SESSION INTO DB" );
   		            
						}

		                }
   						

   						// if ( $text == "" or $serviceCode == "*384*80*0738371600*1#")  
  		  				//{

  		   				// $response="END Your FREE call is on its way! Sponsored by TUKO \n"; 

		       			// }
               

		        if(isset($level[0]) && $level[0]!="" && !isset($level[1]))
		        {
		        	// After user subscribed
		           
		            $str = $level[0];
		            $string = strlen($str);

		            if ($string == 10){
                         
		            	// $demo = $obj->demo();
                         $checkCall = $obj->checkMaxCall($cellphone);
                         $checksubscriber = $obj->checkSubscriber($cellphone);

		            	if ($checkCall == TRUE && $checksubscriber == TRUE)	{

		            		 $response="END Sorry, FREE calls are limited to 5 calls per person per day. Please try again tomorrow. \n"; 

		            	} else

		            	{


		            	 if ($checksubscriber == TRUE){


		            	 	 $cell = substr($level[0],1);
		            		 $msisdn_2 = "254".$cell;
		            	 	 $response="END Your FREE call is on its way! Sponsored by TUKO \n";
		            		 // log call 
		            		 //Store the session
		            		
		            		 $call= start_AdVoiceCall($cellphone, $msisdn_2);
		            		 //Updating call
		         	  		 $obj->updateCall($cellphone);
		            		 $obj->saveCall($cellphone, $msisdn_2); 
		            		// $sleep = sleep(45);
		            		  global $loggerObj;
		            		  $loggerObj->LogInfo("WAITING FOR THE CALL TO FINISH FOR SMS SENDING 45 min");
    						//  $loggerObj->LogInfo($sleep);
     						 
     						// $sleep = delay($cellphone, $msisdn_2);

		            		  exec('/usr/bin/php ; sleep 5 ; /usr/bin/php ussd/kenyaApp/delaysms.php');
		            				            	
		            	}else{

 							$response="END Sorry,Please dial *384*11# to subscribe to make a FREE calls. \n"; 
		            		
			                }

		            	}

	                 // $str = $level[0];

		                }else if ($str <= 4 ){




		                				    $obj->saveSession($cellphone, $str);
		               													
										   		$response="END You will be required to select 1. Yes to subscribe and make FREE calls.  \n"; 
										   		sleep(15);  	
										        $mobile="+".$cellphone;
					                	    	$obj->getToken($mobile);
					                         	$obj->UpdateToken($mobile, $cellphone);
					                            // $cell="%2B".$cellphone;
					      //                	$mobile="+".$cellphone;
											    // $cell = urlencode($mobile);
					                   		    $obj->sendSubscription($mobile, $cellphone);

		               						 
		               							//$response="END";     





		       		        
                        		  }else {
		            	       $response="END Thank you. We hope you come back."; 		           
		               
		           		 }
  
		           
		        }


                
		        else if(isset($level[1]) && $level[1]!="" && !isset($level[2])){

		        		// Get msisdn 2 
		         		// TOKEN SUBMISSION

		             if ($level[1] == 1) {
		             	 $response="CON Thank you! Please enter the number of the person you wish to call for free \n"; 

		             	 	 $cell = substr($level[1],1);
		            		 $msisdn_2 = "254".$cell;

		             	 $obj->updateDestNumber($cellphone, $msisdn_2) ;  

		             } else if ($level[1] == 2) {

		             	 $response="END Thank you! Good bye\n";     
		             }

		        	



/// WORKING CODE

		              


		        }


		        		// else {
		       	        else if(isset($level[2]) && $level[2]!="" && !isset($level[3])){



		            
                        //$response="CON Thank you!$str \n"; 


		       	           $cell = substr($level[2],1);
		                $msisdn_2 = "254".$cell;

                         $response="END Your FREE call is on its way! Sponsored by TUKO $level[2]\n"; 

		                // Update Msisdn 2
		              

		                $obj->updateDestNumber($cellphone, $msisdn_2);
		                //Updating call
		         	    $obj->updateCall($cellphone);
		                $call= start_AdVoiceCall($cellphone, $msisdn_2);
		             //   $sleep= sleep(45);
		                global $loggerObj;
		                $loggerObj->LogInfo("WAITING FOR THE CALL TO FINISH FOR SMS SENDING 45 min");
    				   // $loggerObj->LogInfo($sleep);

		          

		                //Send SMS TO LEG A
		                $msisdn= "+".$cellphone;
		                $message = "Your call was sponsored by tuko.co.ke. Visit tuko.co.ke for breaking news.";
		            	//$obj->sendSMStoLegA($username, $apikey, $msisdn, $message);

		            	//Send SMS TO LEG B
		                $dest_msisdn= "+".$msisdn_2;
		                $message = "Your friend's call was FREE and sponsored by TUKO. You too can make a FREE call by dialing *384*11#.";
		            	//$obj->sendSMStoLegB($username, $apikey, $dest_msisdn, $message);



                         }







				        header('Content-type: text/plain');
				        echo $response;

    } //End of main if statement



?>