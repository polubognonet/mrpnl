<?php

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';


$sql_u = "SELECT * FROM wptj_users";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

      $userreferal = $row['referralcode'];
      $lastchange = $row['lastchange'];
      $useridnew = $row['ID'];
      $refcommision = $row["todayprofita"] * 0.05;

      if ($row['lastchange']!=$row['lastchangeb']) {
        $sql_f = "UPDATE wptj_users SET lastchangeb = ? WHERE ID = ?;";
        $stmt = $conn->prepare($sql_f);
        $stmt->bind_param("si", $lastchange, $useridnew);
        $stmt->execute();
        mysqli_stmt_close($stmt);
        $sql_a = "SELECT * FROM wptj_usermeta WHERE user_id='$useridnew' AND meta_key='referralcode'";
        $newresult = $conn->query($sql_a);
        if ($newresult->num_rows > 0) {
        while($newrow = $newresult->fetch_assoc()) {
          $refusercode = $newrow['meta_value'];
          if ($refusercode!="") {
            $sql_c = "SELECT * FROM wptj_users WHERE referralcode='$refusercode'";
            $newlyresult = $conn->query($sql_c);
            if ($newlyresult->num_rows > 0) {
              while($newlyrow = $newlyresult->fetch_assoc()) {
                if ($newlyrow['vipstatus']=="1") {
                  $refcommision = $refcommision * 2;
                } elseif ($newlyrow['vipstatus']=="2") {
                  $refcommision = $refcommision * 3;
                }
                $requiredamount = $newlyrow['refferalprofita'] + $refcommision;
                $newrequiredamount = number_format($requiredamount, 2);
                $sql_b = "UPDATE wptj_users SET refferalprofita = ? WHERE referralcode = ?;";
                $stmt = $conn->prepare($sql_b);
                $stmt->bind_param("si", $newrequiredamount, $refusercode);
                $stmt->execute();
                  }
                }
              }
            }
          }
        }
}
}

header("Location: https://mrpnl.com/myaccount/qwertyamelisto123123ww.php");




 ?>
