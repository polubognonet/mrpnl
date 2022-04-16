<?php

if (isset($_POST['codegenerator'])) {

session_start();
include 'dbh.inc.php';
include 'userparsing.inc.php';



$referralcode = rand(10000000,99999999);
$sql = "UPDATE wptj_users SET referralcode = ? WHERE ID = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $referralcode, $userid);
$stmt->execute();
header("Location: https://mrpnl.com/jump");
echo "row inserted";


}

 ?>
