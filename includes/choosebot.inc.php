<?php

if (isset($_POST['botbutton1'])) {

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';

$checkedbot=0;
$sql = "UPDATE wptj_users SET botentered = ? WHERE ID = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $checkedbot, $userid);
$stmt->execute();
header("Location: https://mrpnl.com/myaccount/index.php");
echo "row inserted";

}
elseif (isset($_POST['botbutton2'])) {

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';

$checkedbot=1;
$sql = "UPDATE wptj_users SET botentered = ? WHERE ID = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $checkedbot, $userid);
$stmt->execute();
header("Location: https://mrpnl.com/myaccount/index.php");
echo "row inserted";
}







 ?>
