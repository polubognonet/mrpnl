<?php


session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';

$currentdate = date ("d");
$finaldate = "1" . $currentdate;

$sql_u = "SELECT * FROM statisticprofit";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $username = $row["username"];
      $monthlyresult = $row['101'] + $row['102'] + $row['103'] + $row['104'] + $row['105'] + $row['106'] + $row['107'] + $row['108'] + $row['109'] + $row['110'] + $row['111'] + $row['112'] + $row['113'] + $row['114'] + $row['115'] + $row['116'] + $row['117'] + $row['118'] + $row['119'] + $row['120'] + $row['121'] + $row['122'] + $row['123'] + $row['124'] + $row['125'] + $row['126'] + $row['127'] + $row['128'] + $row['129'] + $row['130'] + $row['131'];
      $currentday1 = $currentdate - 1;
      $finaldate1 = "1" . $currentday1;
      $currentday2 = $currentdate - 2;
      $finaldate2 = "1" . $currentday2;
      $currentday3 = $currentdate - 3;
      $finaldate3 = "1" . $currentday3;
      $currentday4 = $currentdate - 4;
      $finaldate4 = "1" . $currentday4;
      $currentday5 = $currentdate - 5;
      $finaldate5 = "1" . $currentday5;
      $currentday6 = $currentdate - 6;
      $finaldate6 = "1" . $currentday6;
      $weeklyresult = $row["${finaldate}"] + $row["${finaldate1}"] + $row["${finaldate2}"] + $row["${finaldate3}"] + $row["${finaldate4}"] + $row["${finaldate5}"] + $row["${finaldate6}"];
      $sql_b = "UPDATE wptj_users SET weeklyprofit = ?, monthlyprofit = ? WHERE user_nicename = ?;";
      $stmt1 = $conn->prepare($sql_b);
      $stmt1->bind_param("sss", $weeklyresult, $monthlyresult, $username);
      $stmt1->execute();
  }
}

header("Location: https://mrpnl.com/myaccount/qwertyamelisto123123ww.php?statistic" . $finaldate1);
 ?>
