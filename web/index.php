<?php
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                	$m_message = $message['text'];$type= $message['type'];$displayName1= $message['displayName'];
                    
                    if($m_message!=""){
			$a=file_get_contents(https://api.line.me/v2/bot/message/reply);
                    	$ch = curl_init($a);
	                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		                'Authorization: Bearer {' . $channel_access_token . '}',
	                ));
			$json_content = curl_exec($ch);
			curl_close($ch);
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $displayName1
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
