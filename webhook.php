<?php

$accessToken =   "EAAC9sf6wUfcBAIODEohtGdUkqqZATpZAjoAaVpbPoV3z7Np2DVrRMEC8Uy8ZBjwPYP9ZBt1Lv5DNjkNSdWJrbdXKKfemjVF1KGw8GRhETnxqb0ZC7Wt4lZAE8dRYb7YL4QEE6MCn8lUdLCxjuAvyT3UC60dT1WDXPKoxZCDjSnMzxPRfgWchG28";


if (isset($_REQUEST['hub_challenge'])) {
  $c = $_REQUEST['hub_challenge'];
  $v = $_REQUEST['hub_verify_token']
  if($v == "1029384756"){
    echo $c;
  }
}

$input = json_decode(file_get_contents('php://input'),true);

$userID = $input['entry'][0]['messaging'][0]['sender']['id'];

$messageArray = $input['entry'][0]['messaging'][0]['message'];
if(isset($messagingArray['postback'])){
  if($messagingArray['postback']['payload'] == 'first hand shake'){
    sendTextMessage("Ciao!");
    die();
  }
}

if(isset($messagingArray['message'])){
  $sentMessage = $messagingArray['message']['text'];
  if(isset$messagingArray['message']['is_echo'])){
    die();
  }else if($sentMessage == "Inizia"){
 $response = '{
  "recipient":{
    "id":"'.$userID.'"
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
}




function sendTextMessage($message) {
  global $accessToken;
  global $userID;
  $url = "https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken";
  
   $jsonData = "{
    'recipient' :{
      'id': $userID
      },
      'message': {
        'text': $message'
      }
    }";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
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


function sendRawResponse($rawResponse){
  global $accessToken;
  $url = "https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken";
  
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $rawResponse);
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
