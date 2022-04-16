<?php

session_start();
include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";
include "/var/www/mrpnl.com/myaccount/includes/dbhstrategy.inc.php";

require_once "functions1.php";

$apikey = $argv[1];
$apisec = $argv[2];
$userd = $argv[3];
$i = $argv[4];

$tableName = "orders" . $i;

list($tgchat, $coin1, $n1, $one1, $coin2, $n2, $one2, $coin3, $n3, $one3, $curr, $fulldeposit, $ordersamount, $mydeposit, $pricedeviation, $takeprofit, $martingale, $pricemartin, $newpricemartin, $liveadd, $smartdca, $firstorderdev) = getUserInformation($userd, $tableName);

$coin = 0;
$n = 0;
$one = 0;

if ($i == "1") {
  $coin = $coin1;
  $n = $n1;
  $one = $one1;
} elseif ($i == "2") {
  $coin = $coin2;
  $n = $n2;
  $one = $one2;
} elseif ($i == "3") {
  $coin = $coin3;
  $n = $n3;
  $one = $one3;
}

$cointotrade = $coin.$curr;
$finalcoin = strtoupper($cointotrade);

require '/var/www/mrpnl.com/myaccount/checkorders/vendor/autoload.php';
$api = new Binance\API("{$apikey}","{$apisec}");

$ticker = $api->prices();
$balances = $api->balances($ticker);
$busdUser = $balances['BUSD']['available'];
$usdtUser = $balances['USDT']['available'];
$bnbUser = $balances['BNB']['available'];
$pricebnb   = $api->price("BNBUSDT");
$usdtbnb    = $fulldeposit * 0.01;
$finalqtbnb = $usdtbnb / $pricebnb;

checkMoney($userd, $busdUser, $usdtUser, $bnbUser, $finalqtbnb, $mydeposit, $tgchat, $curr);

 $price = $api->price("{$finalcoin}");

 $solprice = $price;

 $sql_jh = "UPDATE `$tableName` SET startprice = ?, coin = ?, one = ?, oni = ? WHERE username = ?;";
 $stmt1 = $conn->prepare($sql_jh);
 $stmt1->bind_param("sssss", $solprice, $finalcoin, $one, $n, $userd);
 $stmt1->execute();

 $actualPriceMartin = $pricemartin;

 if ($smartdca == "1") {
     $actualPriceMartin = $newpricemartin;
 }

 $firstorder = ($mydeposit * ($martingale - 1)) / (pow($martingale, $ordersamount) - 1);
 $order1     = number_format($firstorder, 2, ".", "");

 for ($i = 2; $i <= $ordersamount; $i++) {
     $t = $i - 1;
     if ($i !== $ordersamount) {
         ${"order" . $i} = ${"order" . $t} * $martingale;
     } else {
         ${"order" . $i} = ${"order" . $t} * $martingale - 1;
     }
 }

 $orderr1 = $firstorderdev;
 $nn     = $n;

 for ($i = 2; $i <= $ordersamount; $i++) {
     ${"orderr" . $i} = ($orderr1 * (pow($actualPriceMartin, $i) - 1)) / ($actualPriceMartin - 1);
 }

 for ($i = 1; $i <= $ordersamount; $i++) {
     $orderr = ${"orderr" . $i};
     $order  = ${"order" . $i};
     setMain($i, $one, $nn, $solprice, $orderr, $order, $finalcoin, $userd, $api, $tableName, $ordersamount);
 }

  // shell_exec('php ../phpcheck/index.php 2>../phpcheck/phpchecklog.txt');
 // shell_exec('nohup nice -n 19 php ../phpcheck/index.php > ../phpcheck/phpchecklog.txt &');

  // header("Location: https://mrpnl.com/myaccount/phpcheck/index.php");

  ?>
