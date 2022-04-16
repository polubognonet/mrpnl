<?php

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';


$sql_u = "SELECT * FROM wptj_users WHERE trialstarted = '1'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

      $useridnew =  $row['ID'];
      $userr = $row['trialfirststart'];
      $sec = strtotime($userr);
      $currentdate = date ("Y/m/d");
      $newdate = date ("Y/m/d", $sec);
      $sec1 = strtotime($currentdate);
      $sec2 = strtotime($newdate);
      $resultday = $sec1 - $sec2;
      if ($resultday=="0") {
        $dayresult = 0;
      } else {
        $dayresult = date ("d" , $resultday);
      }

      $sql_a = "SELECT * FROM wptj_usermeta WHERE user_id='$useridnew' AND meta_key='referralcode'";
      $newresult = $conn->query($sql_a);
      if ($newresult->num_rows > 0) {
      while($newrow = $newresult->fetch_assoc()) {
        if ($newrow['meta_value']=="tothemoon") {
          $lastdays = 21 - $dayresult;

          if ($lastdays <= 0) {
            $lastdays = 0;
            $sql = "UPDATE wptj_users SET trialdays = ? WHERE ID = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $lastdays, $useridnew);
            $stmt->execute();
          } else {
            $sql = "UPDATE wptj_users SET trialdays = ? WHERE ID = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $lastdays, $useridnew);
            $stmt->execute();
          }
        } else {
          $lastdays = 7 - $dayresult;

          if ($lastdays <= 0) {
            $lastdays = 0;
            $sql = "UPDATE wptj_users SET trialdays = ? WHERE ID = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $lastdays, $useridnew);
            $stmt->execute();
          } else {
            $sql = "UPDATE wptj_users SET trialdays = ? WHERE ID = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $lastdays, $useridnew);
            $stmt->execute();
          }
        }
      }



}
}
}

 ?>
