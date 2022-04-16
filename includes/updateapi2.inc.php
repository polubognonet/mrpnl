<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['removeapi'])) {

  session_start();
  include 'dbh.inc.php';
  include 'dbhapi.inc.php';
  include 'userparsing.inc.php';

  $apikey = $_POST['apikey'];
  $apisecret = $_POST['apisecret'];
  $apinicename = $_POST['apinicename'];
  $apiid = $_POST['apiid'];
  $username = $_POST['username'];
  $hiddenapi = $_POST['hiddenform'];
  $actualworking = $_POST['working'];

  $sql = "DELETE FROM `$username` WHERE id=?";
  $stmtee = $connapi->prepare($sql);
  $stmtee->bind_param("i", $apiid);
  $stmtee->execute();

  $ziro = "0";

  if ($actualworking == "1") {
    $sqlqd = "UPDATE wptj_users SET apinicename = ?, api_key = ?, api_secret = ?, hiddenapi = ? WHERE user_nicename = ?;";
    $stmtss= $conn->prepare($sqlqd);
    $stmtss->bind_param("sssss", $ziro, $ziro, $ziro, $ziro, $username);
    $stmtss->execute();
  }


header("Location: https://mrpnl.com/myaccount/api/?remove=yes");

} elseif (isset($_POST['chooseapi'])) {

  session_start();
  include 'dbh.inc.php';
  include 'dbhapi.inc.php';
  include 'userparsing.inc.php';

  $apikey = $_POST['apikey'];
  $apisecret = $_POST['apisecret'];
  $apiid = $_POST['apiid'];
  $apinicename = $_POST['apinicename'];
  $username = $_POST['username'];
  $hiddenapi = $_POST['hiddenform'];
  $actualworking = $_POST['working'];
  $working = "1";
  $notworking = "0";

  $sql_dud = "SELECT * FROM `$username` WHERE working = '1'";
    $resultdd = $connapi->query($sql_dud);
    if ($resultdd->num_rows > 0) {
      while($rowasd = $resultdd->fetch_assoc()) {
        $idi = $rowasd['id'];
        $sql = "UPDATE `$username` SET working = ? WHERE id = ?;";
        $stmt = $connapi->prepare($sql);
        $stmt->bind_param("si", $notworking, $idi);
        $stmt->execute();
      }
  }

  $sqle = "UPDATE `$username` SET working = ? WHERE id = ?;";
  $stmte = $connapi->prepare($sqle);
  $stmte->bind_param("si", $working, $apiid);
  $stmte->execute();

  $sqlq = "UPDATE wptj_users SET apinicename = ?, api_key = ?, api_secret = ?, hiddenapi = ? WHERE user_nicename = ?;";
  $stmts= $conn->prepare($sqlq);
  $stmts->bind_param("sssss", $apinicename, $apikey, $apisecret, $hiddenapi, $username);
  $stmts->execute();

  header("Location: https://mrpnl.com/myaccount/api/?change=yes");

}

 ?>
