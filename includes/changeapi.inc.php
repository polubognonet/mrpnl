<?php

if (isset($_POST['apibutton'])) {

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';


$apikey = $_POST['apiname'];
$apisecret = $_POST['apisecret'];

try {
  require '../vendor/autoload.php';
  $api = new Binance\API("${apikey}", "${apisecret}");
  $balances = $api->balances();
  if (empty($balances)) {
    throw new Exception('ErrorwithAPI!');
  }
} catch (Exception $e) {
  $ex = $e->getMessage();
  header("Location: https://mrpnl.com/myaccount/index.php?api=bad");
  exit;
}

$apiending = "****";
$hiddenapi = substr("${apikey}", 0,4);
$newhiddenapi = $hiddenapi . $apiending;
$apicorrect = 2;
$sql = "UPDATE wptj_users SET api_key = ?, api_secret = ?, hiddenapi = ?, apicorrect = ? WHERE ID = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssii", $apikey, $apisecret, $newhiddenapi, $apicorrect, $userid);
$stmt->execute();

header("Location: https://mrpnl.com/myaccount/index.php?api=success");
echo "row inserted";

}


 ?>
