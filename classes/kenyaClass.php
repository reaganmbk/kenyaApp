<?php


        require_once 'KLogger.php';
        date_default_timezone_set("Africa/Johannesburg");
        define("LOG_FILE_PATH", "/var/www/html/ussd/kenyaApp/logs/");
        define("LOG_DATE", date("Y-m-d"));
        $loggerObj = new KLogger (LOG_FILE_PATH."KENYA_USSD".LOG_DATE.".log", KLogger::DEBUG );
        $loggerObj->LogInfo("Incoming request for Kenya ussd");


        class kenyaClass{

        public function __construct()
        {
           
              //Database
              $this->db = new PDO('mysql:host=139.162.216.4;dbname=vcalldb', 'root', 'WaugEHDoDDAA');

              
              // if (this->db==true){
              //   // bd log
                
              //   LogInfo("LOG DB CONNECTION");
              //   LogInfo("KENYA DB CONNECTION SUCCESSFUL");
              // }
                           
        }



        // public function demo(){

        //     return false;
        // }

        // Session storage
        public function saveSession($cellphone, $serviceId, $msisdn_2){

             $saveSession = $this->db->prepare("INSERT INTO `campaign_stats` (`tracer_id`, `msisdn`, `message`, `dest_msisdn`, `session_start`, `session_end`, `call_initiated`, `status`,`service_id`) VALUES ('".$_POST["sessionId"]."', '".$cellphone."', '".$_POST["serviceCode"]."', '".$msisdn_2."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 0, 0, '".$serviceId."')");
                  //execute insert query   
                $saveSession->execute();
                global $loggerObj;
                $loggerObj->LogInfo( "SESSION SAVED" );

        }


          // LOGGING CALL
        public function saveCall($cellphone, $msisdn_2, $id){
                global $loggerObj;
                $savecall = $this->db->prepare("INSERT INTO `campaign_stats` (`tracer_id`, `msisdn`, `message`, `dest_msisdn`, `session_start`, `session_end`, `call_initiated`, `status`,`service_id`) VALUES ('".$_POST["sessionId"]."', '".$cellphone."', '".$_POST["serviceCode"]."', '".$msisdn_2."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 1, 1, '".$id."')");
                  //execute insert query   
                $savecall->execute();
                
                $loggerObj->LogInfo( "CALL SAVED" );

        }


               // Store Suscriber
              public function saveSubscriber($phoneNumber, $shortCode,  $keyword, $updateType){
               $saveSub = $this->db->prepare("INSERT INTO `subscribers` (`msisdn`, `shortCode`, `keyword`, `updatetype`, `date`) VALUES ('".$phoneNumber."', '".$shortCode."', '".$keyword."', '".$updateType."', CURRENT_TIMESTAMP)");
                  //execute insert query   
                $saveSub->execute();
                global $loggerObj;
                $loggerObj->LogInfo( "SUBSCRIBER SAVED" );
               }

                    // Store Suscriber
               public function deleteSubscriber($phoneNumber){
               $deleteSession = $this->db->prepare("DELETE * FROM `subscribers` WHERE msisdn= '".$phoneNumber."'");
                  //execute insert query   
                $deleteSession->execute();
                global $loggerObj;
                $loggerObj->LogInfo( "SUBSCRIBER DELETED" );

        }



          // Update the service id
        public function updateCall($cellphone){

              $updateservice = $this->db->prepare("UPDATE `campaign_stats` SET call_initiated = 1 WHERE msisdn = '$cellphone'");
                //execute insert query   
                $updateservice->execute();
                global $loggerObj;
                $loggerObj->LogInfo( "CALL UPDATED" );

        }


             // Update the service id
        public function updateDestNumber($cellphone, $msisdn_2){

              $updatemsisdn_2 = $this->db->prepare("UPDATE `campaign_stats` SET dest_msisdn = $msisdn_2 WHERE msisdn = $cellphone");
                //execute insert query   
              $updatemsisdn_2->execute();
              global $loggerObj;
              $loggerObj->LogInfo( "MSISDN 2 UPDATED" );

        }



         // Check existing subscriber
        public function checkSubscriber($cellphone){

            // global $loggerObj;
            // $loggerObj->LogInfo("Checking if subcriber exists in the db");
            //$phone_number = mysqli_real_escape_string($con,$msisdn);
         
            $checkmsisdn = $this->db->prepare("SELECT * FROM `campaign_stats` WHERE msisdn = $cellphone AND status = 1 order by session_start DESC
            limit 1");
                //execute insert query   

                $checkmsisdn->execute();
                $result = $checkmsisdn->fetchAll();
               // $checkmsisdn->CloseCursor();

              //  $loggerObj->LogInfo(print_r($result, true));
                if(count($result) > 0 ) return TRUE;
                return FALSE;
                global $loggerObj;
                $loggerObj->LogInfo( "CHECK SUBSCRIBER" );
                $loggerObj->LogInfo( print_r($result) );
                                            }


          // Get service Id
        public function getServiceid($cellphone){
         
            $getServiceid = $this->db->prepare("SELECT service_id, msisdn FROM `campaign_stats` WHERE msisdn = $cellphone order by session_start DESC
            limit 1");
                //execute insert query   

                $getServiceid->execute();
                $result = $getServiceid->fetchAll(PDO::FETCH_ASSOC);
                return $result;
               }                                      


         // Check if subscriber has used up all the daily 5 calls


        public function checkMaxCall($cellphone){

            $checkmsisdn2 = $this->db->prepare("SELECT * FROM `campaign_stats` WHERE msisdn = $cellphone and DATE(session_start) = CURRENT_DATE");
                //execute insert query   

                $checkmsisdn2->execute();
                $result = $checkmsisdn2->fetchAll();
               // $checkmsisdn->CloseCursor();

              //  $loggerObj->LogInfo(print_r($result, true));
                if(count($result) === 5) return TRUE;
                return FALSE;
                     global $loggerObj;
                $loggerObj->LogInfo( "CHECK Max 5 CALL PER DAY" );
                $loggerObj->LogInfo( print_r($result) );                     
                }

                                                  // Check existing subscriber
        function checkCalls($cellphone){

            // global $loggerObj;
            // $loggerObj->LogInfo("Checking if subcriber exists in the db");
            //$phone_number = mysqli_real_escape_string($con,$msisdn);
         
            $checkmsisdn = $this->db->prepare("SELECT * FROM `campaign_stats` WHERE msisdn = $cellphone ORDER BY session_start DESC LIMIT 1 ;");
                //execute insert query   

                $checkmsisdn->execute();
                $result = $checkmsisdn->fetchAll();
               // $checkmsisdn->CloseCursor();

              //  $loggerObj->LogInfo(print_r($result, true));
                if(count($result) == 5 ) return true;
                return false;
                                            }
        




          // //  Get MSISDN 2
          // function getMsisdn_2($cellphone)
          // {

          //   // global $loggerObj;
          //   // $loggerObj->LogInfo("Checking if subcriber exists in the db");
          //   //$phone_number = mysqli_real_escape_string($con,$msisdn);
          // //  $date = date('Y-m-d');
          //   $getMsisdn = $this->db->prepare("SELECT dest_msisdn FROM `campaign_stats` WHERE msisdn = $cellphone ORDER BY session_start DESC LIMIT 1 ");
          //       //execute insert query   

          //      $dest_msisdn = $getMsisdn->fetchColumn();
          //      return $result;
          //      // $checkmsisdn->CloseCursor();
                
          //     //  $loggerObj->LogInfo(print_r($result, true));
                
          //  }    // return $result;




     //  CURL FUNCTION

    public function curlHTTPRequest($url, $params, $http_header){
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
      }




          /* initiate the call to AdVoice Api */
          public function start_AdVoiceCall($cellphone, $msisdn_2, $demo=null)
         {
        

         // $loggerObj->LogInfo("======================== ADVOICE API STARTING CALL =======================");

          $params = array(
              'username' => 'BLDS',
              'password' => 'Advoice2017',
              array(
                  "contact" => $msisdn,
                  "status" => '1',
                  "additional_vars" => '{"transfer_phonenumber":"'.$msisdn_2.'"}',
                 // "phonebook" => 'http://129.232.209.250/rest-api/phonebook/907/'
                  'phonebook' => 'http://129.232.209.250/rest-api/phonebook/362/'
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
      }    



      //Send sms to leg A

      public function sendSMStoLegA($username, $apikey, $msisdn, $message){
     
   
          $sender = $msisdn;
          $reply_message = urlencode($message);


      

          $uri = "https://api.africastalking.com/restless/send?username=$username&Apikey=$apikey&to=$sender&message=$reply_message";
         // var_dump($uri);
          $lines=file_get_contents($uri);
         // var_dump($lines);

           global $loggerObj;
          $loggerObj->LogInfo( "SMS SENT TO LEG A" );
          $loggerObj->LogInfo( $lines);
      }   


        //Send sms to leg B

      public function sendSMStoLegB($username, $apikey, $dest_msisdn, $message){
     
   
          $sender = $dest_msisdn;
          $reply_message = urlencode($message);


        

          $uri = "https://api.africastalking.com/restless/send?username=$username&Apikey=$apikey&to=$sender&message=$reply_message";
         // var_dump($uri);
          $lines=file_get_contents($uri);
         // var_dump($lines);

           global $loggerObj;
          $loggerObj->LogInfo( "SMS SENT TO LEG B" );
          $loggerObj->LogInfo( $lines);
      }  





             //Send sms to Subscriber

      public function sendSMStoSubscriber($username, $apikey, $dest_msisdn, $message){
     
   
          $sender = $dest_msisdn;
          $reply_message = urlencode($message);

          $uri = "https://api.africastalking.com/restless/send?username=$username&Apikey=$apikey&to=$sender&message=$reply_message";
         // var_dump($uri);
          $lines=file_get_contents($uri);
         // var_dump($lines);

           global $loggerObj;
           $loggerObj->LogInfo( "SMS SENT TO SAFARICOM SUBSCRIBER" );
           $loggerObj->LogInfo( $lines);
          }      
                                        

      // GET TOKEN  for subscription

      public function getToken($mobile){


               $postdata = http_build_query(
                  array(
                      'phoneNumber' => $mobile
                  )
              );

              $opts = array('http' =>
                  array(
                      'method'  => 'POST',
                      'header'  => 'Content-type: application/x-www-form-urlencoded',
                      'content' => $postdata
                  )
              );

              $context  = stream_context_create($opts);

              $result = file_get_contents('https://api.africastalking.com/checkout/token/create', false, $context);
             // var_dump(json_decode($result, true));
              $data = json_decode($result, true);
              return $data;
             // global $loggerObj;
             // $loggerObj->LogInfo( "GET TOKEN" );
             // $loggerObj->LogInfo( $data );

      }

        // Update TOKEN

         public function UpdateToken($mobile, $cellphone){

             $data = $this->getToken($mobile);
             $token = $data['token'];
             $description = $data['description'];



             $updateToken = $this->db->prepare("UPDATE `campaign_stats` SET token = '".$token."', description = '".$description."' WHERE msisdn = '".$cellphone."'");
              //execute insert query   
             $updateToken->execute();
             global $loggerObj;
             $loggerObj->LogInfo( "TOKEN UPDATED" );
             $loggerObj->LogInfo(  $token );   
          }



           // Update Subscriber

         public function UpdateSubcsriber($phoneNumber){
            
             $updateToken = $this->db->prepare("UPDATE `campaign_stats` SET status = 1  WHERE msisdn = '".$phoneNumber."'");
              //execute insert query   
             $updateToken->execute();
             global $loggerObj;
             $loggerObj->LogInfo( "SUBSCRIPTION STATUS UPDATED" );
            // $loggerObj->LogInfo(  $token );   
          }


          // SEND  subscription

      public function sendSubscription($mobile, $cellphone){

               $data = $this->getToken($mobile);
               $token = $data['token'];
               //$chToken = $token;

               global $loggerObj;
               $loggerObj->LogInfo("GET TOKEN FOR CURL TO SAFARICOM");
               $loggerObj->LogInfo($token);

            //  $url ="https://api.africastalking.com/version1/subscription/create";

            //    $data = array(
            //     'username' => $username,
            //     'phoneNumber' => $mobile,
            //     'shortCode' => '22384',
            //     'keyword' => 'vcall',
            //     'checkoutToken' => $token
            //                 );


            // $postData =  http_build_query($data) ;

              $curl = curl_init();
              curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.africastalking.com/version1/subscription/create",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "username=versatel&phoneNumber=$cellphone&shortCode=22384&keyword=vcall&checkoutToken=$token",
              CURLOPT_HTTPHEADER => array(
              "apikey: bab675f3caa2a595f66bc3f669581c05929e962585e4470bb1b6f25a9be0a2db",
              "cache-control: no-cache",
              "content-type: application/x-www-form-urlencoded"
              ),
             ));

             $response = curl_exec($curl);
            //  var_dump($response);
             global $loggerObj;
             $loggerObj->LogInfo("Subscribe Request");
             $loggerObj->LogInfo($response);
             

            $err = curl_error($curl);

            curl_close($curl);

            // if ($err) {
            //   echo "cURL Error #:" . $err;
            // } else {
            //   echo $response;

            //  //  global $loggerObj;
            //  // $loggerObj->LogInfo( "Subscription response" );
            //  // $loggerObj->LogInfo( $response);  
           
            // }
             
      }




}
?>