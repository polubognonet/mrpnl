<?php

session_start();
include 'includes/dbh.inc.php';
include 'includes/userparsing.inc.php';


try {
$apikey = $user['api_key'];
$apisecret = $user['api_secret'];

require 'vendor/autoload.php';
$api = new Binance\API("${apikey}", "${apisecret}");

  $balances = $api->balances();
  if (!empty($balances)) {
    $apicorrect = 2;
    $sql = "UPDATE wptj_users SET apicorrect = ? WHERE ID = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ii", $apicorrect, $userid);
      $stmt->execute();
  } elseif (empty($balances)) {
    throw new Exception('ErrorwithAPI!');
    $apicorrect = 1;
    $sql = "UPDATE wptj_users SET apicorrect = ? WHERE ID = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ii", $apicorrect, $userid);
      $stmt->execute();
  }
} catch (Exception $e) {
  $ex = $e->getMessage();
  echo $ex;
}




 ?>
