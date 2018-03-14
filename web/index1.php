<?php
//require __DIR__ . '/../vendor/autoload.php';
require_once('./LINEBotTiny.php');
//require_once('/../web/LINEBotTiny.php');
require_once __DIR__ . '/../src/LINEBot.php';
require_once __DIR__ . '/../src/LINEBot/Constant/Meta.php';
require_once __DIR__ . '/../src/LINEBot/HTTPClient.php';
require_once __DIR__ . '/../src/LINEBot/HTTPClient/CurlHTTPClient.php';
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($channelAccessToken);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
/*$bot = new \LINE\test\src\LINEBot\HTTPClient(new CurlHTTPClient($channelAccessToken), [
    'channelSecret' => $channelSecret
]);*/

$res = $bot->getProfile('Ub28a7054f2aa2bfeeb103fb53ca35f32');
//if ($res->isSucceeded()) {
 //   $profile = $res->getJSONDecodedBody();
 //   $displayName = $profile['displayName'];
 //   $statusMessage = $profile['statusMessage'];
 //   $pictureUrl = $profile['pictureUrl'];
//}
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                	$m_message = $message['text'];$type= $message['type'];$displayName1= $message['displayName'];
                    if($m_message!=""){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $m_message
                            ))));
                    };
                    $str = "Hello World";
                    $file = fopen("abc.txt","a+");
                    fwrite($file,$str);
                    fclose($file);

                    break;
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
