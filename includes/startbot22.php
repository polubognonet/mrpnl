<?php

session_start();
include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";
include "/var/www/mrpnl.com/myaccount/includes/dbhstrategy.inc.php";

require_once "functions2.php";

$apikey = $argv[1];
$apisec = $argv[2];
$userd = $argv[3];
$i = $argv[4];
$start = $argv[5];
$coin = $argv[6];

$tableName = "orders" . $i;

list($tgchat, $n, $one, $curr, $fulldeposit, $ordersamount, $mydeposit, $pricedeviation, $takeprofit, $martingale, $pricemartin, $newpricemartin, $liveadd, $smartdca, $firstorderdev, $price) = getUserInformation($userd, $tableName);

$finalcoin = $coin;

require '/var/www/mrpnl.com/myaccount/checkorders/vendor/autoload.php';
$api = new Binance\API("{$apikey}","{$apisec}");

 $solprice = $price;

 $actualPriceMartin = $newpricemartin;

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

 for ($i = $start; $i <= $ordersamount; $i++) {
     $orderr = ${"orderr" . $i};
     $order  = ${"order" . $i};
     setMain($i, $one, $nn, $solprice, $orderr, $order, $finalcoin, $userd, $api, $tableName, $ordersamount, $firstorderdev);
 }

  // shell_exec('php ../phpcheck/index.php 2>../phpcheck/phpchecklog.txt');
 // shell_exec('nohup nice -n 19 php ../phpcheck/index.php > ../phpcheck/phpchecklog.txt &');

  // header("Location: https://mrpnl.com/myaccount/phpcheck/index.php");

  ?>
