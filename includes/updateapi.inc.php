<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['apibutton'])) {

session_start();
include 'dbh.inc.php';
include 'dbhapi.inc.php';
include 'userparsing.inc.php';


$apikey = $_POST['apiname'];
$apisecret = $_POST['apisecret'];
$apinicename = $_POST['apinicename'];
$username = $_POST['username'];

if (!ctype_alnum($apinicename)) {
  header("Location: https://mrpnl.com/myaccount/api/?charachters=bad");
  exit;
}

if (strlen($apinicename) > 15) {
  header("Location: https://mrpnl.com/myaccount/api/?char=toomany");
  exit;
}

$sql_ku = "SELECT * FROM `$username` WHERE apinicename = '{$apinicename}'";
  $resultk = $connapi->query($sql_ku);
  if ($resultk->num_rows > 0) {
      while($rowasd = $resultk->fetch_assoc()) {
    header("Location: https://mrpnl.com/myaccount/api/?exists=yes");
    exit;
  }
}

$sql_u = "SELECT * FROM `$username`";
  $result = $connapi->query($sql_u);
  if ($result->num_rows > 10) {
    header("Location: https://mrpnl.com/myaccount/api/?toomany=yes");
    exit;
    }

try {
  require '../vendor/autoload.php';
  $api = new Binance\API("${apikey}", "${apisecret}");
  $balances = $api->balances();
  if (empty($balances)) {
    throw new Exception('ErrorwithAPI!');
  }
} catch (Exception $e) {
  $ex = $e->getMessage();
  header("Location: https://mrpnl.com/myaccount/api/?bad=yes");
  exit;
}

$apiending = "****";
$hiddenapi = substr("${apikey}", 0,10);
$newhiddenapi = $hiddenapi . $apiending;
$besthi = strtoupper($newhiddenapi);
$working = "0";
$sql = "INSERT INTO `$username` (working, apinicename, apikey, apisecret, hiddenform) VALUES (?, ?, ?, ?, ?)";
$stmte = $connapi->prepare($sql);
$stmte->bind_param("sssss", $working, $apinicename, $apikey, $apisecret, $besthi);
$stmte->execute();

header("Location: https://mrpnl.com/myaccount/api/?success=yes");
echo "row inserted";

}


 ?>
