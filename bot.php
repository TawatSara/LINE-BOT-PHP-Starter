<?php
/**
 * Eric Draken
 * Date: 2016-09-02
 * Time: 4:44 PM
 * Desc: Callback for responding to Line messages
 *       Send 'whoami' to this endpoint to get a reply with your mid.
 */
 
// I put constants like 'LINE_CHANNEL_ID' here 
//require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . "/../includes/line-bot-sdk/vendor/autoload.php";
 
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\GuzzleHTTPClient;
 
// Set these values
$config = [
    'channelId' => LINE_CHANNEL_ID,
    'channelSecret' => LINE_CHANNEL_SECRET,
    'channelMid' => LINE_CHANNEL_MID,
];
$sdk = new LINEBot($config, new GuzzleHTTPClient($config));
 
$postdata = @file_get_contents("php://input");
$messages = $sdk->createReceivesFromJSON($postdata);
 
// Verify the signature
// REF: http://line.github.io/line-bot-api-doc/en/api/callback/post.html#signature-verification
// REF: http://stackoverflow.com/a/541450
$sigheader = 'X-LINE-ChannelSignature';
$signature = @$_SERVER[ 'HTTP_'.strtoupper(str_replace('-','_',$sigheader)) ];
if($signature && $sdk->validateSignature($postdata, $signature)) {
    // Next, extract the messages
    if(is_array($messages)) {
        foreach ($messages as $message) {
            if ($message instanceof LINEBot\Receive\Message\Text) {
                $text = $message->getText();
                if (strtolower(trim($text)) === "whoami") {
                    $fromMid = $message->getFromMid();
                    $user = $sdk->getUserProfile($fromMid);
                    $displayName = $user['contacts'][0]['displayName'];
 
                    $reply = "You are $displayName, and your mid is:\n\n$fromMid";
 
                    // Send the mid back to the sender and check if the message was delivered
                    $result = $sdk->sendText([$fromMid], $reply);
                    if(!$result instanceof LINE\LINEBot\Response\SucceededResponse) {
                        error_log('LINE error: ' . json_encode($result));
                    }
                } else {
                    // Process normally, or do nothing
                }
            } else {
                // Process other types of LINE messages like image, video, sticker, etc.
            }
        }
    } // Else, error
} else {
    error_log('LINE signatures didn\'t match: ' . $signature);
}

/*
//อ่านค่าจาก Text File
$text1='ABC';
$handle = @fopen("current.txt", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        //echo $buffer;
        $text1 = $buffer;
    }
    if (!feof($handle)) {
        //echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
//echo $text1;

$access_token = '2JuqcsF333xgqJabnVYZAtSiGpZvG6l3L3eMlFheS65EAfiTET2FA5xri/1p+oehtPc0lRBxY8c6A6iJS6vduF9XCbhIulXRta6Z35THEY73EdusC1biLCvav/KfKfTLy4eeQcEHmKC304xUe/QgxAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			//$stringtemp = ' By PSD 555';
			$stringtemp = $text1;
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			$userId = $event['userId'];
			$groupId = $event['groupId'];
			$roomID = $event['roomID'];
			$text .= $stringtemp . "\r\n" . $replyToken . "\r\n =>" . strlen($replyToken);
			$text .= "\r\n UserId:" . $userId ;
			$text .= "\r\n GroupId:" . $groupId ;
			$text .= "\r\n RoomId:" . $roomID ;

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
*/
