<?php


include "dbhhistory.inc.php";
$userd = "polubognonet";

$finalprice = 0;

$sql_u = "SELECT * FROM `$userd` WHERE `datecurr` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY)";
  $result = $connhistory->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $profit = $row['profit'];
      $finalprice = $finalprice + $profit;
    }
}

echo $finalprice;
