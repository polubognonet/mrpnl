<?php

if (isset($_POST['setDepositButton'])) {

session_start();
include 'dbh.inc.php';

$usercurrency = $_POST['strategyCurrency'];
$newdeposit = $_POST['strategyDeposit'];
$username = $_POST['username'];

$sql_u = "SELECT * FROM wptj_users WHERE user_nicename='{$username}'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $apikey = $row['api_key'];
      $apisec = $row['api_secret'];
      if ($apikey !== "0" && $apisec !== "0") {
        require "../checkorders/vendor/autoload.php";
        $api = new Binance\API("{$apikey}", "{$apisec}");

        try {
          $ticker = $api->prices(); // Make sure you have an updated ticker object for this to work
        } catch (\Exception $e) {
          header("Location: https://mrpnl.com/myaccount/dca/?api=bad");
          exit;
        }
        $balances = $api->balances($ticker);
        $busdavailable = $balances['BUSD']['available'].PHP_EOL;
        $usdtavailable = $balances['USDT']['available'].PHP_EOL;
        $bnbavailable = $balances['BNB']['available'].PHP_EOL;

        $newbusdavailable = number_format($busdavailable, 2, '.', '');
        $newusdtavailable = number_format($usdtavailable, 2, '.', '');
        $newbnbavailable = number_format($bnbavailable, 5, '.', '');

        $pricebnb   = $api->price("BNBUSDT");

      }
    }
  }

if ($usercurrency=="usdt") {
  if ($newdeposit>$newusdtavailable) {
    header("Location: https://mrpnl.com/myaccount/dca/?udeposit=bad");
    exit;
  }
  $usdtbnb    = $newdeposit * 0.01;
  $finalqtbnb = $usdtbnb / $pricebnb;
  if ($newbnbavailable < $finalqtbnb) {
    header("Location: https://mrpnl.com/myaccount/dca/?bnb=bad");
    exit;
  }
} elseif ($usercurrency=="busd") {
  if ($newdeposit>$newbusdavailable) {
    header("Location: https://mrpnl.com/myaccount/dca/?bdeposit=bad");
    exit;
  }
}

if ($newdeposit>100000) {
  $newdeposit = 100000;
}

$sql = "UPDATE wptj_users SET botdeposit = ?, currentcurrency = ? WHERE user_nicename = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $newdeposit, $usercurrency, $username);
$stmt->execute();
header("Location: https://mrpnl.com/myaccount/dca/?change=success");
echo "row inserted";

}

 ?>
