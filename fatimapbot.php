<?php
/**
 * Created by PhpStorm.
 * User: FATIMA
 * Date: 2/1/2016
 * Time: 12:42 AM
 */

define('BOT_TOKEN', '185440131:AAEmNoW1ptPwKuQbHGfKnxVJYXKGcpb54Xc');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

function processMessage($message){
    // process incoming message
    $chatId = $message['chat']['id'];
    if (isset($message['text'])) {
        // incoming text message
        $text = $message['text'];

        if (strpos($text, "/hello") === 0) {
            sendMessage(array('chat_id' => $chatId, "text" => 'Hello'));

        } else if (strpos($text, "/bye") === 0) {
            sendMessage(array('chat_id' => $chatId, "text" => 'Bye'));
        }
    }

}


function sendMessage($text){
    $handle = curl_init(API_URL);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($text));
    curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

    $response = curl_exec($handle);
    $response = json_decode($response, true);
    return $response;

}

// read incoming info
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (!$update) {
    // receive wrong update, must not happen
    exit;
}

if (isset($update["message"])) {
    processMessage($update["message"]);
}