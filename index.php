<?php
if(strtoupper($_SERVER['REQUEST_METHOD'])!='POST'){
    phpinfo();

}
define('BOT_TOKEN','355942211:AAEYxq-ws482hdsElWQwIoHmU3jqnHIEIG8');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

/*$up_id='';
$message_id='';
function GetUpdateId(){
    $obj=json_decode(file_get_contents(API_URL."getUpdates"));
    $fin=end($obj->result);
    $GLOBALS['up_id']=$fin->update_id;
}
for(;;){
    GetUpdateId();
    $fin=json_decode(file_get_contents(API_URL."getUpdates?offset=".$up_id));
    if((($fin->result[0]->message->text)=="سلام"&& ($message_id != $fin->result[0]->message->message_id))){
        $rep=json_decode(file_get_contents(API_URL."sendMessage?chat_id=".$fin->result[0]->message->chat->id."&text=".urldecode("سلام. خوبی !؟")));
        $GLOBALS['message_id']=$fin->result[0]->message->message_id;
    }
}
*/

/*
$content= json_decode(file_get_contents("php://input"));

if($content->message->text=="سلام"){
    $rep=json_decode(file_get_contents(API_URL."SendMessage?chat_id=".$content->message->chat->id."&text=".urldecode("سلام. خوبی !؟")));
    echo "Ok";
}
*/
$content= json_decode(file_get_contents("php://input"),true);
$message = $content['message'];
$message_id = $message['message_id'];
$chatId = $message['chat']['id'];

$ar = explode(',',$message['text']);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO test (username, email) VALUES ('$ar[0]','$ar[1]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$last_id = $conn->insert_id;
$conn->close();
//$rep=json_decode(file_get_contents(API_URL."SendMessage?chat_id=".$chatId."&text=".$response));
$url=API_URL.'sendMessage?chat_id=%d&text=%s';
$ch=curl_init(sprintf($url, $chatId, $last_id));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);
curl_close($ch);
//$rep=json_decode(file_get_contents(sprintf($url, $chatId, $response)));
echo "Ok";
