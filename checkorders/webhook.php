<?php

include '../includes/dbh.inc.php';

$input = file_get_contents('php://input');

$rsicof = 0;
$levelcof1 = 0;
$movecof1 = 0;

$sql_d = "SELECT * FROM ordershelp WHERE username = `polubognonet`";
  $resultd = $conn->query($sql_d);
  if ($resultd->num_rows > 0) {
    while($rowd = $resultd->fetch_assoc()) {
      $levelcof1 = $rowd['levcof'];
      $movecof1 = $rowd['movecof'];
    }
}

$rsicof = "0";
$levelcof = "0";
$movecof = "0";
$actualcof = "0";
$rsisma = "0";

if ($input == "RSIup70") {
  $rsicof = 0.93;
} elseif ($input == "RSIup90") {
  $rsicof = 0.86;
} elseif ($input == "RSIdown70") {
  $rsicof = 1;
} elseif ($input == "RSIdown30") {
  $rsicof = 1.075;
} elseif ($input == "RSIdown10") {
  $rsicof = 1.15;
} elseif ($input == "RSIup30") {
  $rsicof = 1;
} elseif ($input == "SUPbroken") {
  $levelcof = 1.05;
} elseif ($input == "RESbroken") {
  $levelcof = 0.95;
} elseif ($input == "BTC2up") {
  $movecof = 1.05;
} elseif ($input == "BTC2down") {
  $movecof = 0.95;
} elseif ($input == "RSISMAup") {
  $rsisma = 0.93;
} elseif ($input == "RSISMAdown") {
  $rsisma = 1.07;
}

if ($rsicof !== "0") {
  $sql = "UPDATE ordershelp SET rsicof = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $rsicof);
  $stmt->execute();
}

if ($levelcof !== "0") {
  $sql = "UPDATE ordershelp SET levcof = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $levelcof);
  $stmt->execute();
}

if ($movecof !== "0") {
  $sql = "UPDATE ordershelp SET movecof = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $movecof);
  $stmt->execute();
}

if ($rsisma !== "0") {
  $sql = "UPDATE ordershelp SET rsismacof = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $rsisma);
  $stmt->execute();
}

$sql_u = "SELECT * FROM ordershelp WHERE username = `polubognonet`";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $rsicof2 = $row['rsicof'];
      $levelcof2 = $row['levcof'];
      $movecof2 = $row['movecof'];
      $rsismacof2 = $row['rsismacof'];
      $actualcof = $rsicof2 * $levelcof2 * $movecof2 * $rsismacof2;
    }
}

$sqlq = "UPDATE ordershelp SET cof = ?;";
$stmtq = $conn->prepare($sqlq);
$stmtq->bind_param("s", $actualcof);
$stmtq->execute();

$text = urlencode(" New cof is: {$actualcof}!");

try {
  $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
  file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=466212284&text=$text");
} catch (\Exception $e) {

}

 ?>
