<?php

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';
$currentdate = date ("d");


$sql_u = "SELECT * FROM wptj_users";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {


      $useridnew = $row["ID"];
      $username = $row["user_nicename"];
      $currentdate = date ("d");
      $todayprofit = $row["todayprofita"];
      $idealrow = "1" . $currentdate;

        if ($row["todayprofita"]!=$row["todayprofitb"] && $row["trialdays"]=="0") {

        	$commision = $row["todayprofita"] * 0.2;
        	$currentbalance = $row["balance"] - $commision;
          $newcurrentbalance = number_format($currentbalance, 2, '.', '');

        	$sql = "UPDATE wptj_users SET balance = ?, todayprofitb = ? WHERE ID = ?;";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("ssi", $newcurrentbalance, $todayprofit, $useridnew);
					$stmt->execute();

        }
        $sql_b = "UPDATE statisticprofit SET `${idealrow}` = ? WHERE username = ?;";
        $stmt1 = $conn->prepare($sql_b);
        $stmt1->bind_param("ss", $todayprofit, $username);
        $stmt1->execute();
      }
    }
    header("Location: https://mrpnl.com/myaccount/qwertyamelisto123123ww.php?".$idealrow);


 ?>
