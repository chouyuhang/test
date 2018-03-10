<?php
namespace chouyuhang\Tests\LINEBot;
use chouyuhang\LINEBot;
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$bot = new \LINE\LINEBot(new CurlHTTPClient('WI8f+ot/+7IJffBJATgfi1+rnNYCW+RGm1u2SRg2sdOLw2Y0+4gbdJsmh0zmUdtZNvx595o+hvI3XYeFQk66EVpl1mWwDDJOlKRecD6mc8gES9hnbAH+SOcrxw3QWmrmvQPI0WxrXMwB8EVOXPx4FwdB04t89/1O/w1cDnyilFU='), [
    'channelSecret' => 'a7e8c58d4744adbc363c42bc558db89e'
]);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                	$m_message = $message['text'];$type= $message['type'];$displayName1= $message['displayName'];
                    $res = $bot->getProfile('user-id');
                    $profile = $res->getJSONDecodedBody();
                    $displayName = $profile['displayName'];
                    $statusMessage = $profile['statusMessage'];
                    $pictureUrl = $profile['pictureUrl'];
                    if($m_message!=""){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $displayName.$displayName1
                            ))));
                    }
                    break;           
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
