<?php

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';

if (isset($_POST['profitbutton'])) {
  if (isset($_POST['deposit']) && is_numeric($_POST['deposit'])) {
    if (isset($_POST['months'])  && is_numeric($_POST['months'])) {
      $months = $_POST['months'];
      $deposit = $_POST['deposit'];
      if ($_POST['choosebot']=="stableprofit") {
        $cof = 10;
      } else {
        $cof = 15;
      }
      $CI = $deposit * (pow((1 + $cof / 100), $months));
      $newCI = number_format($CI, 0 , '', '');
      $sql = "UPDATE wptj_users SET lastdepositcalc = ? WHERE ID = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("si", $deposit, $userid);
      $stmt->execute();
      mysqli_stmt_close($stmt);
    } else {
      header("Location: https://mrpnl.com/myaccount/index.php?pmonths=bad");
      exit;
    }
  } else {
    header("Location: https://mrpnl.com/myaccount/index.php?pdeposit=bad");
    exit;
  }
}

header("Location: https://mrpnl.com/myaccount/index.php?result=".$newCI);


 ?>
