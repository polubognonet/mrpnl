<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'dbh.inc.php';
include 'dbhstrategy.inc.php';

$id = $_POST['strategyid'];
$username = $_POST['username'];
echo $username;

$sql_u = "SELECT * FROM wptj_users WHERE user_nicename = '$username'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $activebot = $row['activebot'];
      $botdeposit = $row['botdeposit'];
    }
  }

if (isset($_POST['use'])) {

  $ziro = 0;
  $one = 1;

  $sql_a = "SELECT * FROM `$username` WHERE id = '$id';";
    $results = $connstr->query($sql_a);
    if ($results->num_rows > 0) {
      while($rows = $results->fetch_assoc()) {
        $mindep = $rows['mindep'];
      }
    }

    if ($mindep > $botdeposit) {
      header("Location: https://mrpnl.com/myaccount/dca/?changestr=notenough");
      exit;
      echo "row inserted";
    } elseif ($activebot == "2") {
      header("Location: https://mrpnl.com/myaccount/dca/?bot=active");
      exit;
    } else {

      $sql = "UPDATE `$username` SET working = ? WHERE working = 1;";
      $stmt = $connstr->prepare($sql);
      $stmt->bind_param("i", $ziro);
      $stmt->execute();

      $sql1 = "UPDATE `$username` SET working = ? WHERE id = '{$id}';";
      $stmt = $connstr->prepare($sql1);
      $stmt->bind_param("i", $one);
      $stmt->execute();

      print_r($mysqli->error_list);

      header("Location: https://mrpnl.com/myaccount/dca/?changestr=success");
      echo "row inserted";
    }

} elseif (isset($_POST['remove'])) {

  $sql_a = "SELECT * FROM `$username` WHERE id = '$id';";
    $results = $connstr->query($sql_a);
    if ($results->num_rows > 0) {
      while($rows = $results->fetch_assoc()) {
        $working = $rows['working'];
      }
    }

    if ($working == "1" && $activebot == "2") {
      header("Location: https://mrpnl.com/myaccount/dca/?removestr=bad");
      exit;
    } else {
      $sql = "DELETE FROM `$username` WHERE id = '$id';";
      if ($connstr->query($sql) === TRUE) {
           header("Location: https://mrpnl.com/myaccount/dca/?removestr=success");
           exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

} elseif (isset($_POST['edit'])) {

  session_start();

  if ($activebot == "2") {
    header("Location: https://mrpnl.com/myaccount/dca/?bot=active");
    exit;
  } else {
    $sql_ud = "SELECT * FROM `$username` WHERE id = '$id';";
      $resultd = $connstr->query($sql_ud);
      if ($resultd->num_rows > 0) {
        while($rows = $resultd->fetch_assoc()) {
          $_SESSION['idstr'] = $rows["id"];
          $_SESSION['working'] = $rows["working"];
          $_SESSION['name'] = $rows["name"];
          $_SESSION['coinsamount'] = $rows["coinsamount"];
          $_SESSION['ordersamount'] = $rows["ordersamount"];
          $_SESSION['takeprofit'] = $rows["takeprofit"];
          $_SESSION['martingale'] = $rows["martingale"];
          $_SESSION['firstorderdev'] = $rows["firstorderdev"];
          $_SESSION['pricemartin'] = $rows["pricemartin"];
          $_SESSION['liveadd'] = $rows["liveadd"];
          $_SESSION['smartdca'] = $rows["smartdca"];
          $_SESSION['dynamictp'] = $rows["dynamictp"];
          $_SESSION['pullupgrid'] = $rows["pullupgrid"];

        }
      }

      header("Location: https://mrpnl.com/myaccount/dca/?edit=yes");
      exit;
  }

} elseif (isset($_POST['clone'])) {

  $sql_ud = "SELECT * FROM `$username` WHERE id = '$id';";
    $resultd = $connstr->query($sql_ud);
    if ($resultd->num_rows < 11 && $resultd->num_rows > 0) {
      while($rows = $resultd->fetch_assoc()) {
        $working = 0;
        $name = $rows["name"];
        $coinsamount = $rows["coinsamount"];
        $ordersamount = $rows["ordersamount"];
        $pricedeviation = $rows["pricedeviation"];
        $takeprofit = $rows["takeprofit"];
        $martingale = $rows["martingale"];
        $firstorderdev = $rows["firstorderdev"];
        $pricemartin = $rows["pricemartin"];
        $newpricemartin = $rows["newpricemartin"];
        $liveadd = $rows["liveadd"];
        $smartdca = $rows["smartdca"];
        $dynamictp = $rows["dynamictp"];
        $pullupgrid = $rows["pullupgrid"];
        $mindep = $rows["mindep"];
      }

      $sql = "INSERT INTO `$username` (name, working, coinsamount, ordersamount, pricedeviation, takeprofit, martingale, pricemartin, newpricemartin, pullupgrid, liveadd, smartdca, dynamictp, firstorderdev, mindep) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmte = $connstr->prepare($sql);
      $stmte->bind_param("sissssssssiiiss", $name, $working, $coinsamount, $ordersamount, $pricedeviation, $takeprofit, $martingale, $pricemartin, $newpricemartin, $pullupgrid, $liveadd, $smartdca, $dynamictp, $firstorderdev, $mindep);

      header("Location: https://mrpnl.com/myaccount/dca/?clone=success");
      exit;

    } else {
      header("Location: https://mrpnl.com/myaccount/dca/?clone=bad");
      exit;
    }

}
