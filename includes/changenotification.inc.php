<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);


session_start();
include 'dbh.inc.php';

$dailyprofit1 = 0;
$probemails1 = 0;
$adveremails1 = 0;
$telegramdeals1 = 0;
$tgdailyp1 = 0;

$dailyprofit = $_POST['dailyprofit'];
$probemails = $_POST['probemails'];
$adveremails = $_POST['adveremails'];
$telegramdeals = $_POST['telegramdeals'];
$tgdailyp = $_POST['tgdailyp'];
$username = $_POST['username'];

if ($dailyprofit == "") {
  $dailyprofit1 = 0;
} else {
  $dailyprofit1 = 1;
}
if ($probemails == "") {
  $probemails1 = 0;
} else {
  $probemails1 = 1;
}
if ($adveremails == "") {
  $adveremails1 = 0;
} else {
  $adveremails1 = 1;
}
if ($telegramdeals == "") {
  $telegramdeals1 = 0;
} else {
  $telegramdeals1 = 1;
}
if ($tgdailyp == "") {
  $tgdailyp1 = 0;
} else {
  $tgdailyp1 = 1;
}

$sql = "UPDATE wptj_users SET user_profitemails = ?, user_probemails = ?, user_adveremails = ?, user_telegramdeals = ?, user_tgdailyp = ? WHERE user_nicename = '$username';";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiii", $dailyprofit1, $probemails1, $adveremails1, $telegramdeals1, $tgdailyp1);
$stmt->execute();

header("Location: https://mrpnl.com/myaccount/profile/?changes=success");
exit;


 ?>
