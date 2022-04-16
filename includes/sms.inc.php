<?php
//Send an SMS using Gatewayapi.com
$url = "https://gatewayapi.com/rest/mtsms";
$api_token = "0eHU50CyS-yWBunHezhWzAcqILmFPqg_EF5aTuU9E-nIBmzUtwp181n7QYBGB2Ex";

//Set SMS recipients and content

$recipients = [$phonenum];
$json = [
    'sender' => 'mrpnl',
    'message' => 'Hello, your MRPNL code is: '.$otpcode.' . Thank you!',
    'recipients' => [],
];
foreach ($recipients as $msisdn) {
    $json['recipients'][] = ['msisdn' => $msisdn];
}

//Make and execute the http request
//Using the built-in 'curl' library
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
curl_setopt($ch,CURLOPT_USERPWD, $api_token.":");
curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($json));
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
print($result);
$json = json_decode($result);

header("Location: https://mrpnl.com/myaccount/verify/psms.php?status=".$phonenum);
