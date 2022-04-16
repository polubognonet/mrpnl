<?php


    if (isset($_GET['pn'])) {
    $phonenum = $_GET['pn'];

    $sql_u = "SELECT * FROM wptj_users WHERE phonenumber='$phonenum'";
    $res_u = mysqli_query($conn, $sql_u);
    if (mysqli_num_rows($res_u) > 0) {
      header("Location: https://mrpnl.com/myaccount/verify/?number=used");
    } else {
    $otpcode = rand(1000,9999);
    $phonevercount = $user['phonevercount'];
    $currentphonever = $phonevercount + 1;
    $sql = "UPDATE wptj_users SET phonenumber = ?, otpcode = ?, phonevercount = ? WHERE ID = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $phonenum, $otpcode, $currentphonever, $userid);
    $stmt->execute();
    include "sms.inc.php";
    }
  }

 ?>
