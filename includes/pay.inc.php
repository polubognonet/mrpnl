<?php

$amount = $_POST['amount'];


$res = [
      'amount' => $amount,
      'in_curr' => 'USD',
      'merchant' => '4405',
      'lifetime' => '1h40m',
      'merchant_payfee' => '',
      'client_email' => $user['user_email'],
      'externalid' => uniqid(),
      'is_multipay' => 'true',
      'redirect_url' => 'https://mrpnl.com/myaccount/',
      'callback_url' => 'https://mrpnl.com/myaccount/callback.php'
];

$res['sign'] = sign_form_data('VhfPO7xJpK6IupF0b8psGapHc26pIFuB71q8yXmEhFnPSX_tLoY5VADQyHJrQFiY09HH', $res);

function sign_form_data($key, $data) {
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
  return hash_hmac('sha512', strtolower($s), $key);
}
?>
