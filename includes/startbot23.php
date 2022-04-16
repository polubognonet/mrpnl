<?php

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';

$apikey = $argv[1];
$apisec = $argv[2];
$userd = $argv[3];

$sql_dud = "SELECT * FROM wptj_users WHERE user_nicename = '{$userd}'";
  $resultdd = $conn->query($sql_dud);
  if ($resultdd->num_rows > 0) {
    while($rowasd = $resultdd->fetch_assoc()) {
      $curr = $rowasd['currentcurrency'];
    }
}

$sql_duda = "SELECT * FROM ordershelp WHERE username = '{$userd}'";
  $resultdda = $conn->query($sql_duda);
  if ($resultdda->num_rows > 0) {
    while($rowasda = $resultdda->fetch_assoc()) {
      $coin3 = $rowasda['coin3'];
    }
}

$sql = "UPDATE orders2 SET coin = ? WHERE username = '{$userd}'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $coin3);
$stmt->execute();

$sql_dudas = "SELECT * FROM orders2 WHERE username = '{$userd}'";
  $resultddas = $conn->query($sql_dudas);
  if ($resultddas->num_rows > 0) {
    while($rowasdas = $resultddas->fetch_assoc()) {
      $mydeposit = $rowasdas['dep'];
    }
}

$cointotrade = $coin3.$curr;
$finalcoin = strtoupper($cointotrade);

 require '../vendor/autoload.php';
 $api = new Binance\API("{$apikey}","{$apisec}");

 $price = $api->price("{$finalcoin}");

 if ($price>300) {
   $on = 1;
 } elseif ($price>100) {
   $on = 2;
 } elseif ($price>1) {
   $on = 4;
 }

 $solprice = $price;

 $deposit = $mydeposit;
 $firstorder=($deposit*(1.2-1))/(pow(1.2 , 9)-1);
 $order1 = number_format($firstorder, 2, '.', '');
 $order2=$order1*1.1;
 $order3=$order2*1.1;
 $order4=$order3*1.1;
 $order5=$order4*1.1;
 $order6=$order5*1.1;
 $order7=$order6*1.1;
 $order8=$order7*1.1;
 $order9=$order8*1.1-1;

 $orderr1=0.5;
 $orderr2=$orderr1*1.4;
 $orderr3=$orderr2*1.4;
 $orderr4=$orderr3*1.4;
 $orderr5=$orderr4*1.4;
 $orderr6=$orderr5*1.4;
 $orderr7=$orderr6*1.4;
 $orderr8=$orderr7*1.4;
 $orderr9=$orderr8*1.4;

 $solprice1 = $solprice - ($solprice/100*$orderr1);
 $pr1 = round($solprice1, $on);
 $solpricee1 = number_format($pr1, $on, '.', '');
 $solprice2 = $solprice - ($solprice/100*$orderr2);
 $pr2 = round($solprice2, $on);
 $solpricee2 = number_format($pr2, $on, '.', '');
 $solprice3 = $solprice - ($solprice/100*$orderr3);
 $pr3 = round($solprice3, $on);
 $solpricee3 = number_format($pr3, $on, '.', '');
 $solprice4 = $solprice - ($solprice/100*$orderr4);
 $pr4 = round($solprice4, $on);
 $solpricee4 = number_format($pr4, $on, '.', '');
 $solprice5 = $solprice - ($solprice/100*$orderr5);
 $pr5 = round($solprice5, $on);
 $solpricee5 = number_format($pr5, $on, '.', '');
 $solprice6 = $solprice - ($solprice/100*$orderr6);
 $pr6 = round($solprice6, $on);
 $solpricee6 = number_format($pr6, $on, '.', '');
 $solprice7 = $solprice - ($solprice/100*$orderr7);
 $pr7 = round($solprice7, $on);
 $solpricee7 = number_format($pr7, $on, '.', '');
 $solprice8 = $solprice - ($solprice/100*$orderr8);
 $pr8 = round($solprice8, $on);
 $solpricee8 = number_format($pr8, $on, '.', '');
 $solprice9 = $solprice - ($solprice/100*$orderr9);
 $pr9 = round($solprice9, $on);
 $solpricee9 = number_format($pr9, $on, '.', '');

 $quantity1 = $order1/$solprice;
 $quantityy1 = round($quantity1, 2);
 $quantity2 = $order2/$solpricee2;
 $quantityy2 = round($quantity2, 2);
 $quantity3 = $order3/$solpricee3;
 $quantityy3 = round($quantity3, 2);
 $quantity4 = $order4/$solpricee4;
 $quantityy4 = round($quantity4, 2);
 $quantity5 = $order5/$solpricee5;
 $quantityy5 = round($quantity5, 2);
 $quantity6 = $order6/$solpricee6;
 $quantityy6 = round($quantity6, 2);
 $quantity7 = $order7/$solpricee7;
 $quantityy7 = round($quantity7, 2);
 $quantity8 = $order8/$solpricee8;
 $quantityy8 = round($quantity8, 2);
 $quantity9 = $order9/$solpricee9;
 $quantityy9 = round($quantity9, 2);

 $quantity = $quantityy1;
 $price = $solpricee1;
 $order1 = $api->buy("{$finalcoin}", $quantity, $price);
 $quantity = $quantityy2;
 $price = $solpricee2;
 $order2 = $api->buy("{$finalcoin}", $quantity, $price);
 $quantity = $quantityy3;
 $price = $solpricee3;
 $order3 = $api->buy("{$finalcoin}", $quantity, $price);
 $quantity = $quantityy4;
 $price = $solpricee4;
 $order4 = $api->buy("{$finalcoin}", $quantity, $price);
 $quantity = $quantityy5;
 $price = $solpricee5;
 $order5 = $api->buy("{$finalcoin}", $quantity, $price);
 $quantity = $quantityy6;
 $price = $solpricee6;
 $order6 = $api->buy("{$finalcoin}", $quantity, $price);
 $quantity = $quantityy7;
 $price = $solpricee7;
 $order7 = $api->buy("{$finalcoin}", $quantity, $price);
 $quantity = $quantityy8;
 $price = $solpricee8;
 $order8 = $api->buy("{$finalcoin}", $quantity, $price);
 $quantity = $quantityy9;
 $price = $solpricee9;
 $order9 = $api->buy("{$finalcoin}", $quantity, $price);

 $finalorder1 = serialize($order1);
 $finalorder2 = serialize($order2);
 $finalorder3 = serialize($order3);
 $finalorder4 = serialize($order4);
 $finalorder5 = serialize($order5);
 $finalorder6 = serialize($order6);
 $finalorder7 = serialize($order7);
 $finalorder8 = serialize($order8);
 $finalorder9 = serialize($order9);


   $sql = "UPDATE orders2 SET order1 = ?, order2 = ?, order3 = ?, order4 = ?, order5 = ?, order6 = ?, order7 = ?, order8 = ?, order9 = ? WHERE username = ?;";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("ssssssssss", $finalorder1, $finalorder2, $finalorder3, $finalorder4, $finalorder5, $finalorder6, $finalorder7, $finalorder8, $finalorder9, $userd);
   $stmt->execute();
   mysqli_stmt_close($stmt);


  // shell_exec('php ../phpcheck/index.php 2>../phpcheck/phpchecklog.txt');
 // shell_exec('nohup nice -n 19 php ../phpcheck/index.php > ../phpcheck/phpchecklog.txt &');

  // header("Location: https://mrpnl.com/myaccount/phpcheck/index.php");

  ?>
