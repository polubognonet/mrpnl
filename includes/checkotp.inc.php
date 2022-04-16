<?php


if (isset($_POST['checkbutton'])) {

  session_start();
  include_once 'dbh.inc.php';
  include_once 'userparsing.inc.php';
  include_once 'checkreferrals.inc.php';

  $otpcode=$_POST['phone'];
  $goodfinal = 1;
  $res = 0;
  $otpvercount = $user['otpvercount'];

  $sql_u = "SELECT otpcode FROM wptj_users WHERE id='$userid'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $res = $row["otpcode"];
    }
}
  if ($otpcode==$res) {
    $sql = "UPDATE wptj_users SET phoneverified = ? WHERE ID = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $goodfinal, $userid);
    $stmt->execute();
    header("Location: https://mrpnl.com/myaccount/?verify=success");
  } else {
    $otpvercount = $otpvercount + 1;
    $sql = "UPDATE wptj_users SET otpvercount = ? WHERE ID = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $otpvercount, $userid);
    $stmt->execute();
    header("Location: https://mrpnl.com/myaccount/verify/?otpcode=bad");
    }
}

 ?>
