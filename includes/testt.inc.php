<?php


include "dbhhistory.inc.php";
$userd = "polubognonet";

$currdate = date('Y-m-d H:i:s');
$deal = "1";
$coin = "finalcoin";
$profit = "15";

$sql = "INSERT INTO `$userd` (dealid, coin, profit, timecurr, datecurr) VALUES (?, ?, ?, ?, ?)";
$stmte = $connhistory->prepare($sql);
$stmte->bind_param("sssss", $deal, $coin, $profit, $currdate, $currdate);
echo $stmte->execute();
