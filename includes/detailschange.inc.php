<?php

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';

$result = 0;

if (isset($_POST['newname'])) {
  $newname = $_POST['newname'];
  if ($newname!="") {
    $sql = "UPDATE wptj_users SET display_name = ? WHERE ID = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newname, $userid);
    $stmt->execute();
    $result = 1;
  }
}

if (isset($_POST['newemail'])) {
  $newemail = $_POST['newemail'];
  if ($newemail!="") {
    if (filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
          $sql_u = "SELECT * FROM wptj_users WHERE user_email='$newemail'";
          $res_u = mysqli_query($conn, $sql_u);
          if (mysqli_num_rows($res_u) > 0) {
            header("Location: https://mrpnl.com/myaccount/profile.php?email=used");
            exit;
          } else {
            $sql = "UPDATE wptj_users SET user_email = ? WHERE ID = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newemail, $userid);
            $stmt->execute();
            $result = 1;
          }
    } else {
      header("Location: https://mrpnl.com/myaccount/profile.php?email=bad");
      exit;
    }
  }
}

if ($result=="1") {
  header("Location: https://mrpnl.com/myaccount/profile.php?changes=success");
  exit;
} elseif ($result=="0") {
  header("Location: https://mrpnl.com/myaccount/profile.php");
  exit;
}


 ?>
