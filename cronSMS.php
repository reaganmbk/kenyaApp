<?php

require_once('classes/AfricasTalkingGateway.php');
require_once 'classes/kenyaClass.php';

//  // require_once('classes/AfricasTalkingGateway.php');
 $obj = New kenyaClass();

$mobile="+254606917540";
$cellphone = "254712127105";
$username   = "versatel";
$apikey     = "bab675f3caa2a595f66bc3f669581c05929e962585e4470bb1b6f25a9be0a2db";
$shortCode = "22384";
$keyword = "vcall";
//$token = "CkTkn_e8976da6-4f5c-4aff-aec3-3d9a0754936b";



      

             

//           $service_url = 'https://api.africastalking.com/version1/subscription/create?username=versatel';
// $curl = curl_init($service_url);
// $curl_post_data = array(
//                 'username' => 'versatel',
//                 'phoneNumber' => $mobile,
//                 'shortCode' => '22384',
//                 'keyword' => 'vcall',
//                 'checkoutToken' => 'CkTkn_f4763730-e0bc-4c2d-b2af-ad2cd873f366',
//                 'apikey' => 'bab675f3caa2a595f66bc3f669581c05929e962585e4470bb1b6f25a9be0a2db'
// );
//    $data_string = json_encode($data);



// $curl = curl_init();
// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.africastalking.com/version1/subscription/create",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => "phoneNumber=$mobile&username=versatel&shortCode=22384&keyword=vcall&checkoutToken=$token",
//   CURLOPT_HTTPHEADER => array(
//     "apikey: bab675f3caa2a595f66bc3f669581c05929e962585e4470bb1b6f25a9be0a2db",
//     "cache-control: no-cache",
//     "content-type: application/x-www-form-urlencoded",
//   ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }


   // $ch = curl_init($service_url);
   //  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
   //  curl_setopt($ch, CURLOPT_POSTFIELDS, 'username=versatel',$data_string);
    
   //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
   // //   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // // curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
  
   //  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   //            'Content-Type: application/x-www-form-urlencoded',
   //            'Content-Length: ' . strlen($data_string),
   //             'Authorization:Basic bab675f3caa2a595f66bc3f669581c05929e962585e4470bb1b6f25a9be0a2db')
   //  );
   //  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36');
   //  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  
   //  $result = curl_exec($ch);
   //  var_dump($result);
    
   //    curl_close($ch);
  




// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.africastalking.com/version1/subscription/create?username=versatel",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS =>  "phoneNumber=%2B254721803846&username=versatel&shortCode=22384&keyword=vcall&checkoutToken=CkTkn_a08f0b08-8c5c-4f38-a87e-0b2d07db22d2",
//   CURLOPT_HTTPHEADER => array(
//     "apikey: bab675f3caa2a595f66bc3f669581c05929e962585e4470bb1b6f25a9be0a2db",
//     "cache-control: no-cache",
//     'Content-Length: ' . strlen($data_string),
//     "content-type: application/x-www-form-urlencoded",
//   ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }




$obj->getToken($mobile);

$obj->UpdateToken($mobile);

$obj->sendSubscription($mobile, $cellphone, $shortCode, $keyword, $apikey, $username);



// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.africastalking.com/version1/subscription/create",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"phoneNumber\"\r\n\r\n+254706326750\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"username\"\r\n\r\nversatel\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"shortCode\"\r\n\r\n22384\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"keyword\"\r\n\r\nvcall\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"checkoutToken\"\r\n\r\nCkTkn_27456760-14c4-4d87-942d-28ce85025978\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
//   CURLOPT_HTTPHEADER => array(
//     "apikey: bab675f3caa2a595f66bc3f669581c05929e962585e4470bb1b6f25a9be0a2db",
//     "cache-control: no-cache",
//     "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
//     "postman-token: 9f64791f-377b-c8fc-39ca-81b5d6317de3"
//   ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }