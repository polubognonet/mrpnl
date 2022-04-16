<?php

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';

$sql_u = "SELECT * FROM wptj_users WHERE probstarted='1'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['balance']>=0) {

      $useridnew = $row['ID'];
			$newprobemailsent = 0;
			$newprobstarted = 0;
			$newprobstarteddate = "0";
      $newdaystostop = 0;
      $newaccountstopped = 0;

        	$sql = "UPDATE wptj_users SET probemailsent = ?, probstarted = ?, probstarteddate = ?, daystostop = ?, accountstopped = ? WHERE ID = ?;";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("iisiii", $newprobemailsent, $newprobstarted, $newprobstarteddate, $newdaystostop, $newaccountstopped, $useridnew);
			$stmt->execute();
      mysqli_stmt_close($stmt);
        }
    }
}

header("Location: https://mrpnl.com/myaccount/qwertyamelisto123123ww.php?prob=ended");

 ?>
