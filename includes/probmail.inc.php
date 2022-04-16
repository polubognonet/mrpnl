<?php


session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';

$sql_u = "SELECT * FROM wptj_users WHERE probstarted='1' AND probemailsent='0'";
  $result = $conn->query($sql_u);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $useridnew = $row['ID'];

      if ($row['user_probemails']=="1") {
        $mail = $row['user_email'];
        $subject = "High time to top up your balance!";
		$message = "<h4>Hello " . $row['display_name'] . "! </h4> <p>Please be informed that you have 3 days in order to top up your MR.PNL balance.
    <br>Otherwise, your account will be stopped.
    <br><br>
      Here is a link you can use: <a href = 'https://mrpnl.com/myaccount/topup.php'>https://mrpnl.com/myaccount/topup.php</a><br>
        Thank you for your understanding!<br></p>
      <p style = 'opacity = 0.7;'> Sincerely <br> MR.PNL</p>";
		$headers = "Content-type: text/html\r\n";
		$headers .= "From: MR.PNL <support@mrpnl.com> \r\n";
		mail($mail, $subject, $message, $headers);


		$newprobemailsent = 1;

		$sql = "UPDATE wptj_users SET probemailsent = ? WHERE ID = ?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ii", $newprobemailsent, $useridnew);
		$stmt->execute();
  } else {
    header("Location: https://mrpnl.com/myaccount/qwertyamelisto123123ww.php?bad");
    exit;
  }
    }
}

header("Location: https://mrpnl.com/myaccount/qwertyamelisto123123ww.php?good");

 ?>
