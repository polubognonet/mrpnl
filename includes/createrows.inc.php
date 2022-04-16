<?php

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';


$sql_u = "SELECT * FROM wptj_users";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $username = $row['user_nicename'];
      $sql_a = "SELECT * FROM statisticprofit WHERE username = '${username}'";
      $newresult = $conn->query($sql_a);
      if ($newresult->num_rows > 0) {
        } else {
          $sql_b = "INSERT INTO statisticprofit (username) VALUES ('$username');";
          mysqli_query($conn, $sql_b);
        }
      }
    }

header("Location: https://mrpnl.com/myaccount/qwertyamelisto123123ww.php");





 ?>
