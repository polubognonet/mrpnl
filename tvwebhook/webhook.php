<?php

include '../includes/dbh.inc.php';
include '../includes/dbhstrategy.inc.php';


$input = file_get_contents('php://input');

$rsicof = "0";
$actualcof = "0";
$psocof = "0";
$ccicof = "0";
$aroon = "0";


if ($input == "RSIup70") {
  $rsicof = 0.93;
} elseif ($input == "RSIup90") {
  $rsicof = 0.88;
} elseif ($input == "RSIdown70") {
  $rsicof = 1;
} elseif ($input == "RSIdown30") {
  $rsicof = 1.07;
} elseif ($input == "RSIdown10") {
  $rsicof = 1.12;
} elseif ($input == "RSIup30") {
  $rsicof = 1;
} elseif ($input == "PSOUP") {
  $psocof = 0.93;
} elseif ($input == "PSODOWN") {
  $psocof = 1.07;
} elseif ($input == "CCIUP120") {
  $ccicof = 0.92;
} elseif ($input == "CCIDOWN120") {
  $ccicof = 1;
} elseif ($input == "CCIDOWN-120") {
  $ccicof = 1.08;
} elseif ($input == "CCIUP-120") {
  $ccicof = 1;
} elseif ($input == "AROONUP") {
  $aroon = 0.9;
} elseif ($input == "AROONDOWN") {
  $aroon = 1.1;
}

if ($rsicof !== "0") {
  $sql = "UPDATE ordershelp SET rsicof = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $rsicof);
  $stmt->execute();
}

if ($psocof !== "0") {
  $sql = "UPDATE ordershelp SET psocof = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $psocof);
  $stmt->execute();
}

if ($aroon !== "0") {
  $sql = "UPDATE ordershelp SET arooncof = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $aroon);
  $stmt->execute();
}

if ($ccicof !== "0") {
  $sql = "UPDATE ordershelp SET ccicof = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $ccicof);
  $stmt->execute();
}

$sql_u = "SELECT * FROM ordershelp WHERE username = 'polubognonet'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $rsicof2 = $row['rsicof'];
      $psocof2 = $row['psocof'];
      $arooncof2 = $row['arooncof'];
      $ccicof2 = $row['ccicof'];
      $actualcof = ($rsicof2 + $psocof2 + $arooncof2 + $ccicof2)/4;
    }
}

$sql_ud = "SELECT * FROM wptj_users WHERE activebot = '2'";
  $resultasdw = $conn->query($sql_ud);
  if ($resultasdw->num_rows > 0) {
    while($rowdsa = $resultasdw->fetch_assoc()) {
      $userr = $rowdsa['user_nicename'];
      $smartdca = 0;
      $pricemartin = 0;
      $newpricemartin = 0;

      $sql_11 = "SELECT * FROM `$userr` WHERE working = '1'";
        $result11 = $connstr->query($sql_11);
        if ($result11->num_rows > 0) {
          while($row11 = $result11->fetch_assoc()) {
            $smartdca = $row11['smartdca'];
            $pricemartin = $row11['pricemartin'];
          }
        }

      if ($smartdca == "0") {
        $newpricemartin = $pricemartin;
      } else {
        $newpricemartin = $pricemartin * $actualcof;
      }

      $sqlqw = "UPDATE `$userr` SET newpricemartin = ? WHERE working = '1';";
      $stmtq = $connstr->prepare($sqlqw);
      $stmtq->bind_param("s", $newpricemartin);
      $stmtq->execute();

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
