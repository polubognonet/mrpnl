<?php
function sign_data(string $key, array $data, string $utc_now) : string {
    ksort($data);
    $s = '';
    foreach($data as $k=>$value) {
      if (in_array(gettype($value), array('array', 'object', 'NULL')) ){
          continue;
        }
        if(is_bool($value)){
            $s .= $value ? "true" : "false";
        } else {
            $s .= $value;
        }
    }
    $s .= $utc_now;
    return hash_hmac('sha512', strtolower($s), $key);
}


$data = array(
    "method" => "invoice.get",
    "params" => array("externalid" => "3073035"),
    "jsonrpc" => "2.0",
    "id" => "1"
);

$MERCHANT = '4405';
$API_KEY = 'fsr59ZlZupHxefBZ7znc_DYvrFfd_V6XeLPHxraPwZL2QZBsnuHBA4OZqw1PUhBCV5pc';
$utc_now = strval(((int)round(microtime(true) * 1000)));

$data_string = json_encode($data);

$ch = curl_init('https://api.any.money/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string),
    'x-merchant: ' . $MERCHANT,
    'x-signature: ' . sign_data($API_KEY, $data['params'] ?: array(), $utc_now),
    'x-utc-now-ms: ' . $utc_now)
);

$result = curl_exec($ch);
curl_close($ch);
$json = json_decode($result);
print($result);

?>
