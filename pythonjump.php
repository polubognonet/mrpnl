<?php

$currency1 = $_POST['currency'];
$currency = $currency1."-USD";

$usdt="USDT";
require 'vendor/autoload.php';
$api = new Binance\API("XCLEsx8ZKh5Dy3oDUlTW7K1UB3ShvUsnYSGMPrpFQK44QZ3I1DPcbh27IBc0v4MI","skXCO4C9HMNpAGj2szTHJwD1SnG8HOqG3J4LRHe9k1LxW8CoTle5JMDHXU7wngZb");
$coin = $currency1.$usdt;
$price = $api->price("{$coin}");

$command1 = shell_exec('/usr/bin/python3 /var/www/mrpnl.com/public_html/myaccount/candlellevels/levels.py "'.$currency.'" "'.$price.'"');
echo $command1;
$command = shell_exec("which python3");
echo $command;

header("Location: https://mrpnl.com/myaccount/checkpython.php");

 ?>
