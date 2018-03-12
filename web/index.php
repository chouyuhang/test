<?php
use chouyuhang\test\src\LINEBot\HTTPClient\CurlHTTPClient;
require_once('./LINEBotTiny.php'); 
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$httpClient = new \chouyuhang\test\src\LINEBot\HTTPClient\CurlHTTPClient($channelAccessToken);

//$httpClient = new \chouyuhang\test\src\LINEBot\HTTPClient\CurlHTTPClient('WI8f+ot/+7IJffBJATgfi1+rnNYCW+RGm1u2SRg2sdOLw2Y0+4gbdJsmh0zmUdtZNvx595o+hvI3XYeFQk66EVpl1mWwDDJOlKRecD6mc8gES9hnbAH+SOcrxw3QWmrmvQPI0WxrXMwB8EVOXPx4FwdB04t89/1O/w1cDnyilFU=');
/*$bot = new \chouyuhang\src\LINEBot($httpClient, ['channelSecret' => 'a7e8c58d4744adbc363c42bc558db89e']);
$response = $bot->getProfile('Ub28a7054f2aa2bfeeb103fb53ca35f32');
if ($response->isSucceeded()) {
    $profile = $response->getJSONDecodedBody();
    echo $profile['displayName'];
    echo $profile['pictureUrl'];
    echo $profile['statusMessage'];
}*/
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
