<?php


session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';

$sql_u = "SELECT * FROM wptj_users";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
					$useridnew = $row['ID'];
					$userbalance = $row['balance'];
					if ($userbalance<0 && $row['probstarted']=="0") {
						$probstartdate = date ("Y/m/d");
						$currentdate = date ("Y/m/d");
						$sec1 = strtotime($probstartdate);
						$sec2 = strtotime($currentdate);
						$currentresult = $sec2 - $sec1;
						$dayresult = date ("d" , $currentresult);
						if ($dayresult=="31" OR $dayresult=="30" OR $dayresult=="29") {
							$dayresult = 0;
						}
						$lastdays = 3 - $dayresult;
						if ($lastdays<0) {
							$lastdays=0;
						}
						$newprobstarted = 1;
						$sql = "UPDATE wptj_users SET probstarteddate = ?, probstarted = ?, daystostop = ? WHERE ID = ?;";
					  	$stmt = $conn->prepare($sql);
					  	$stmt->bind_param("siii", $probstartdate, $newprobstarted, $lastdays, $useridnew);
					  	$stmt->execute();
					} elseif ($userbalance<0 && $row['probstarted']=="1") {
						$probstartdate = $row['probstarteddate'];
						$currentdate = date ("Y/m/d");
						$sec1 = strtotime($probstartdate);
						$sec2 = strtotime($currentdate);
						$currentresult = $sec2 - $sec1;
						$dayresult = date ("d" , $currentresult);
						if ($dayresult=="31" OR $dayresult=="30" OR $dayresult=="29") {
							$dayresult = 0;
						}
						$lastdays = 3 - $dayresult;
						if ($lastdays<0) {
							$lastdays=0;
						}
						$sql = "UPDATE wptj_users SET daystostop = ? WHERE ID = ?;";
					  	$stmt = $conn->prepare($sql);
					  	$stmt->bind_param("ii", $lastdays, $useridnew);
					  	$stmt->execute();
        }
    }
}

$sql_d = "SELECT * FROM wptj_users WHERE daystostop='0' AND accountstopped='0'";
  $result = $conn->query($sql_d);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if ($row['daystostop']=="0" && $row['probstarted']=="1") {
        $mail = $row["user_email"];
        $subject = "Account disabled!";
		$message = "<h4>Hello " . $row['user_nicename'] . "! </h4> <br> <p>Please be informed that your account is stopped. Also, your bot is disabled. However, current deal is still active. You may check it on the Binance side.<br>
			Here is a link you can use in order to top up your balance: <a href = 'https://mrpnl.com/myaccount/topup.php'>https://mrpnl.com/myaccount/topup.php</a><br>
			Thank you for your understanding!<br></p>
      <p style = 'opacity = 0.7;'> Sincerely <br> MR.PNL</p>";
		$headers = "Content-type: text/html\r\n";
		$headers .= "From: MR.PNL <support@mrpnl.com> \r\n";
		mail($mail, $subject, $message, $headers);

		$useridnew = $row["ID"];
		$newaccountstopped = 1;
    $newactivebot = 0;

		$sql = "UPDATE wptj_users SET activebot = ?, accountstopped = ? WHERE ID = ?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("iii", $newactivebot, $newaccountstopped, $useridnew);
		$stmt->execute();
    mysqli_stmt_close($stmt);
      }
    }
}

header("Location: https://mrpnl.com/myaccount/qwertyamelisto123123ww.php");



 ?>
