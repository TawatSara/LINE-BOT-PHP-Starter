<?php
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
			$text .= $stringtemp . "\r\n" . $replyToken;

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
