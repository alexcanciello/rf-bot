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

if($messageText == "inizia") {

    $response = {
  "recipient":{
    "id":"<PSID>"
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
          },
          {
            ...
          },
          {...}
        ]
      }
    }
  }
}
      

}

//send message to facebook bot


$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));

curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

if(!empty($input)){

$result = curl_exec($ch);

}

curl_close($ch);
