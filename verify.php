<?php
$access_token = '2JuqcsF333xgqJabnVYZAtSiGpZvG6l3L3eMlFheS65EAfiTET2FA5xri/1p+oehtPc0lRBxY8c6A6iJS6vduF9XCbhIulXRta6Z35THEY73EdusC1biLCvav/KfKfTLy4eeQcEHmKC304xUe/QgxAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
