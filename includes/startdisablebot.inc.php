<?php

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';

if (isset($_POST['startbutton'])) {


$botstatus = 1;
$trialstarted = 1;
  if ($user['trialstarted']=="0" OR $user['trialstarted']=="") {
    $currentdate = date('Y-m-d H:i:s');
    $sql = "UPDATE wptj_users SET trialfirststart = ? WHERE ID = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $currentdate, $userid);
    $stmt->execute();
  }
$sql = "UPDATE wptj_users SET activebot = ?, trialstarted = ? WHERE ID = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $botstatus, $trialstarted, $userid);
$stmt->execute();

$userinfo = print_r($user, true);

$to = 'bots@mrpnl.com';
$subject = $user['user_login'] . ' wants to start a bot';
$message = '<h3>Hello Mikhail, here are the details for the bot that should be enabled:</h3><br>' . $userinfo;
$headers = "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers);

$touser = $user['user_email'];
$subjectuser = "Starting bot in progress";
$messageuser = "<h4>Hello " . $user['display_name'] . ". </h4>
<p>Your bot is enabled per your request. It is being configured right now. It could take up to 2 hours.</p>
<br>
<p>If you have not enabled it, please contact us right now via Telegram support (@mrpnl) or email address. <br><br>
<p style = 'opacity = 0.7;'> Sincerely <br> MR.PNL</p>";
$headersuser = "Content-type: text/html\r\n";
$headersuser .= "From: MR.PNL <support@mrpnl.com> \r\n";

mail($touser, $subjectuser, $messageuser, $headersuser);

header("Location: https://mrpnl.com/myaccount/index.php?start=success");
echo "row inserted";

} elseif (isset($_POST['disablebutton'])) {



  $botstatus = 0;
  $sql = "UPDATE wptj_users SET activebot = ? WHERE ID = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $botstatus, $userid);
  $stmt->execute();

  $userinfo = print_r($user, true);

  $to = 'bots@mrpnl.com';
  $subject = $user['user_login'] . ' wants to disable a bot';
  $message = '<h3>Hello Mikhail, here are the details for the bot that should be disabled:</h3><br>' . $userinfo;
  $headers = "Content-type: text/html\r\n";

  mail($to, $subject, $message, $headers);

  $touser = $user['user_email'];
  $subjectuser = "Bot is disabled";
  $messageuser = "<h4>Hello " . $user['display_name'] . ". </h4>
  <p>Your bot is disabled now per your request.</p>
  <br>
  <p>If you have not disabled it, please contact us right now via Telegram support (@mrpnl) or email address. <br><br>
  <p style = 'opacity = 0.7;'> Sincerely <br> MR.PNL</p>";
  $headersuser = "Content-type: text/html\r\n";
  $headersuser .= "From: MR.PNL <support@mrpnl.com> \r\n";

  mail($touser, $subjectuser, $messageuser, $headersuser);

  header("Location: https://mrpnl.com/myaccount/index.php?disable=success");
  echo "row inserted";

}

 ?>
