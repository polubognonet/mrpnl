
<?php

session_start();
include 'includes/dbh.inc.php';
include 'includes/userparsing.inc.php';

$apikey = $user['api_key'];
$apisecret = $user['api_secret'];

try {
  require 'vendor/autoload.php';
  $api = new Binance\API("${apikey}", "${apisecret}");
  $balances = $api->balances();
  if (empty($balances)) {
    throw new Exception('ErrorwithAPI!');
    $apicorrect = 1;
    $sql = "UPDATE wptj_users SET apicorrect = ? WHERE ID = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $apicorrect, $userid);
    $stmt->execute();
  }
} catch (Exception $e) {
  $ex = $e->getMessage();
  $apicorrect = 1;
  $sql = "UPDATE wptj_users SET apicorrect = ? WHERE ID = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $apicorrect, $userid);
    $stmt->execute();
}

if ($user['apicorrect']==0) {
  ?>
  <div class="binanceinformation">
    <div class="binancemain">
      <p>API information is not entered. Please insert the API Key and Secret Key into the "API settings" section in order to review your wallet details.</p>
    </div>
    <div class="binancemainmob">
      <p>API information is not entered. Please insert the API Key and Secret Key into the "API settings" section in order to review your wallet details.</p>
    </div>
  </div>
  <?php
} elseif ($user['apicorrect']==1) {
  ?>
  <div class="binanceinformation">
    <div class="binancemain">
      <p>Your API information has been changed or deleted. Please double-check it on the Binance side.</p>
    </div>
    <div class="binancemainmob">
      <p>Your API information has been changed or deleted. Please double-check it on the Binance side.</p>
    </div>
  </div>
  <?php
}

if ($user['apicorrect']==2) {
$api_key = $user['api_key'];
$api_secret = $user['api_secret'];

require 'vendor/autoload.php';
$api = new Binance\API("${api_key}","${api_secret}");
$ticker = $api->prices(); // Make sure you have an updated ticker object for this to work
$balances = $api->balances($ticker);
$busdlocked = $balances['BUSD']['onOrder'].PHP_EOL;
$usdtlocked = $balances['USDT']['onOrder'].PHP_EOL;
$busdavailable = $balances['BUSD']['available'].PHP_EOL;
$usdtavailable = $balances['USDT']['available'].PHP_EOL;

$newbusdlocked = number_format($busdlocked, 2, '.', '');
$newusdtlocked = number_format($usdtlocked, 2, '.', '');
$newbusdavailable = number_format($busdavailable, 2, '.', '');
$newusdtavailable = number_format($usdtavailable, 2, '.', '');

$busdtotal = $newbusdlocked + $newbusdavailable;
$usdttotal = $newusdtlocked + $newusdtavailable;

?>

<div class="binanceinformation">
  <div class="binancemainmob">
    <div class="binancemobmoney">
      <div class="moneymobheader">
        <p>BUSD</p>
      </div>
      <div class="mobmain">
        <div class="mobmoney">
          <p>TOTAL:</p>
          <?php echo "<p>$" . $busdtotal . "</p>" ?>
        </div>
        <div class="mobmoney">
          <p>AVAILABLE:</p>
          <?php echo "<p>$" . $newbusdavailable . "</p>" ?>
        </div>
        <div class="mobmoney">
          <p>LOCKED:</p>
          <?php echo "<p>$" . $newbusdlocked . "</p>" ?>
        </div>
      </div>
    </div>
    <div class="binancemobmoney">
      <div class="moneymobheader">
        <p>USDT</p>
      </div>
      <div class="mobmain">
        <div class="mobmoney">
          <p>TOTAL:</p>
          <?php echo "<p>$" . $usdttotal . "</p>" ?>
        </div>
        <div class="mobmoney">
          <p>AVAILABLE:</p>
          <?php echo "<p>$" . $newusdtavailable . "</p>" ?>
        </div>
        <div class="mobmoney">
          <p>LOCKED:</p>
          <?php echo "<p>$" . $newusdtlocked . "</p>" ?>
        </div>
      </div>
    </div>
  </div>
  <div class="binancemain">
    <div class="busdbinance">
      <div class="busddetails">
        <?php
        echo "<p>BUSD AVAILABLE: $" . $newbusdavailable . "</p>";

        $sql_b = "UPDATE wptj_users SET busdavailable = ? WHERE ID = ?;";
        $stmt1 = $conn->prepare($sql_b);
        $stmt1->bind_param("si", $newbusdavailable, $userid);
        $stmt1->execute();
        ?>
      </div>
    </div>
    <div class="usdtbinance">
      <div class="usdtdetails">
        <?php
        echo "<p>USDT AVAILABLE: $" . $newusdtavailable . "</p>";

        $sql_a = "UPDATE wptj_users SET usdtavailable = ? WHERE ID = ?;";
        $stmt1 = $conn->prepare($sql_a);
        $stmt1->bind_param("si", $newusdtavailable, $userid);
        $stmt1->execute();
        ?>
      </div>
    </div>
  </div>
</div>
  <?php
}
?>
