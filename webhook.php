<?php

// parameters

$hubVerifyToken = '1029384756';

$accessToken =   "EAADUjeEDo2EBAPjbFwgkvP4YkzWeZAJD8ElMyYUX2NnFiNpHNhsjEWL9OpjLtMPAJR2S0H3heoST1ZBOo1XhjHIwVNrxMkWlKJYRtYKvzUidb7NZB0SCvEN1hIar6SViNlvOrSMOtgFFEuXhCm5KdqOVG0UDSIwCLYMzYYZACAIRpWHjifvV";

// check token at setup

if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {

  echo $_REQUEST['hub_challenge'];

  exit;

}

// handle bot's anwser

$input = json_decode(file_get_contents('php://input'), true);

$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];

$messageText = $input['entry'][0]['messaging'][0]['message']['text'];

$response = null;

//set Message

if($messageText == "Inizia") {

    $response = '{
  "recipient":{
    "id":"'.$senderId.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"What do you want to do next?",
        "buttons":[
          {
            "type":"web_url",
            "url":"https://www.messenger.com",
            "title":"Visit Messenger"
          }
        ]
      }
    }
  }
}';
sendRawResponse($response);     

}

function sendTextMessage($message) {
  global $accessToken;
  global $senderID;
  $url = "https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken";
  
   $jsonData = "{
    'recipient' :{
      'id': $senderID
      },
      'message': {
        'text': $message'
      }
    }";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_Data);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_exec($ch);
 
  $errors = curl_error($ch);
  $response = curl_getinfo(&ch, CURLINFO_HTTP_CODE);

  var_dump($errors);
  var_dump($response);

  curl_close($ch);
}


function sendRawResponse($response){
  global $accessToken;
  $url = "https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken";
  
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_Data);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_exec($ch);
 
  $errors = curl_error($ch);
  $response = curl_getinfo(&ch, CURLINFO_HTTP_CODE);

  var_dump($errors);
  var_dump($response);

  curl_close($ch);
}
