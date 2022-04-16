<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

session_start();
include "dbh.inc.php";
include "dbhstrategy.inc.php";

if (isset($_POST['startStrategyButton'])) {


  $liveadd = 0;
  $smartdca = 0;
  $working = 0;
  $dynamictp = 0;
  $pullUp = 0;
  $name = $_POST["strategyName"];
  $coins = $_POST["strategyCoins"];
  $orders = $_POST["strategyOrders"];
  $deviation = $_POST["strategyDeviation"];
  $profit = $_POST["strategyProfit"];
  $martin = $_POST["strategyMartin"];
  $firstOrder = $_POST["strategyFirstorder"];
  $stepScale = $_POST["strategyStepScale"];
  $minDep = $_POST["strategyMindep"];
  $liveadd1 = $_POST["strategyLiveadd"];
  $smartdca1 = $_POST["strategySmartdca"];
  $pullUp1 = $_POST["strategyPullup"];
  $dynamictp1 = $_POST["strategyDynamicTP"];
  $userd = $_POST['username'];

  $sql_ud = "SELECT * FROM `$userd`";
    $resultd = $connstr->query($sql_ud);
    if ($resultd->num_rows > 10) {
      header("Location: https://mrpnl.com/myaccount/dca/?str=toomany");
      exit;
    }

if ($name == "") {
  header("Location: https://mrpnl.com/myaccount/dca/?name=error");
  exit;
}

if ($liveadd1 == "") {
  $liveadd = 0;
} else {
  $liveadd = 1;
}

if ($smartdca1 == "") {
  $smartdca = 0;
} else {
  $smartdca = 1;
}

if ($pullUp1 == "1") {
  $pullUp = 0;
} else {
  $pullUp = $pullUp1;
}

if ($dynamictp1 == "") {
  $dynamictp = 0;
} else {
  $dynamictp = 1;
}
/*
$sql_u = "SELECT * FROM wptj_users WHERE user_nicename = '{$userd}'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $apikey = $row['api_key'];
      $apisecret = $row['api_secret'];
      $deposit = $row['botdeposit'];
    }
}

require '../checkorders/vendor/autoload.php';
$api = new Binance\API("{$apikey}","{$apisecret}");
$pricebnb = $api->price("BNBUSDT");
$usdtbnb = $deposit * 0.01;
$finalqtbnb = $usdtbnb / $pricebnb;

$ticker = $api->prices();
$balances = $api->balances($ticker);
if ($currency == "busd") {
  if ($balances['BUSD']['available'] < $deposit) {
    header("Location: https://mrpnl.com/myaccount/dca/?busd=notenough");
    exit;
  }
} elseif ($currency == "usdt") {
  if ($balances['USDT']['available'] < $deposit) {
    header("Location: https://mrpnl.com/myaccount/dca/?usdt=notenough");
    exit;
  }
  if ($balances['BNB']['available'] < $finalqtbnb) {
    header("Location: https://mrpnl.com/myaccount/dca/?bnb=notenough");
    exit;
  }
}
*/
$newpricemartin = $stepScale;
echo $newpricemartin;

$sql = "INSERT INTO `$userd` (name, working, coinsamount, ordersamount, pricedeviation, takeprofit, martingale, pricemartin, newpricemartin, pullupgrid, liveadd, smartdca, dynamictp, firstorderdev, mindep) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmte = $connstr->prepare($sql);
$stmte->bind_param("sissssssssiiiss", $name, $working, $coins, $orders, $deviation, $profit, $martin, $stepScale, $newpricemartin, $pullUp, $liveadd, $smartdca, $dynamictp, $firstOrder, $minDep);
echo $stmte->execute();


header("Location: https://mrpnl.com/myaccount/dca/?strategy=success");
exit;

} elseif (isset($_POST['editStrategyButton'])) {

  $liveadd = 0;
  $smartdca = 0;
  $dynamictp = 0;
  $pullUp = 0;
  $idstr = $_POST["idstr"];
  $working = $_POST["working"];
  $name = $_POST["strategyName"];
  $coins = $_POST["strategyCoins"];
  $orders = $_POST["strategyOrders"];
  $deviation = $_POST["strategyDeviation"];
  $profit = $_POST["strategyProfit"];
  $martin = $_POST["strategyMartin"];
  $firstOrder = $_POST["strategyFirstorder"];
  $stepScale = $_POST["strategyStepScale"];
  $minDep = $_POST["strategyMindep"];
  $liveadd1 = $_POST["strategyLiveadd"];
  $smartdca1 = $_POST["strategySmartdca"];
  $pullUp1 = $_POST["strategyPullup"];
  $dynamictp1 = $_POST["strategyDynamicTP"];
  $userd = $_POST['username'];

if ($name == "") {
  header("Location: https://mrpnl.com/myaccount/dca/?name=error");
  exit;
}

if ($liveadd1 == "") {
  $liveadd = 0;
} else {
  $liveadd = 1;
}

if ($smartdca1 == "") {
  $smartdca = 0;
} else {
  $smartdca = 1;
}

if ($pullUp1 == "1") {
  $pullUp = 0;
} else {
  $pullUp = $pullUp1;
}

if ($dynamictp1 == "") {
  $dynamictp = 0;
} else {
  $dynamictp = 1;
}

$newpricemartin = $stepScale;

$sqlff = "UPDATE `$userd` SET name = ?,working = ? ,coinsamount = ? ,ordersamount = ? ,pricedeviation = ? ,takeprofit = ? ,martingale = ? ,pricemartin = ? ,newpricemartin = ? ,pullupgrid = ? ,liveadd = ? ,smartdca = ? ,dynamictp = ? ,firstorderdev = ?, mindep = ? WHERE id = ?;";
$stmt = $connstr->prepare($sqlff);
$stmt->bind_param("sissssssssiiissi", $name, $working, $coins, $orders, $deviation, $profit, $martin, $stepScale, $newpricemartin, $pullUp, $liveadd, $smartdca, $dynamictp, $firstOrder, $minDep, $idstr);
$stmt->execute();

header("Location: https://mrpnl.com/myaccount/dca/?strategy=changed");
exit;

}
