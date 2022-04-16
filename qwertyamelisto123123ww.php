
<?php

session_start();
include 'includes/dbh.inc.php';
include 'includes/userparsing.inc.php';

 ?>

<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <form class="" action="includes/startnohup.inc.php" method="post">
      <button type="submit" name="button">Go</button>
    </form>


<br>
<br>
<br>
<br>
<br>



    <form class="" action="qwertyamelisto123123ww.php" method="post">
      <p>Lastchange:</p>
      <input type="text" name="newlastchange" autocomplete="off">
      <p>Profits:</p>
      <input style="height: 150px; word-wrap: break-word; word-break: break-all;" type="text" name="profits" autocomplete="off">
      <button type="submit" name="button">Submit</button>
    </form>

    <?php

    if (isset($_POST['newlastchange'])) {
      if ($_POST['newlastchange']!="") {

    $total = 0;
    $newlastchange = $_POST['newlastchange'];
    $newtodayprofita = "0.00";
    $sql_a = "SELECT * FROM wptj_users";
    $result = $conn->query($sql_a);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
          $useridnew = $row["ID"];
          $sql = "UPDATE wptj_users SET lastchange = ?, todayprofita = ? WHERE ID = ?;";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ssi", $newlastchange, $newtodayprofita, $useridnew);
          $stmt->execute();
          mysqli_stmt_close($stmt);
        }
    }
    }
    }

    if (isset($_POST['profits'])) {
      if ($_POST['profits']!="") {
        $profitstext = $_POST['profits'];
        $array = explode("Уважаемый", $profitstext);
        unset($array[0]);
        foreach ($array as $arraypart) {

          $arraypart = preg_replace("/[^a-zа-яё0-9\.\s]/i", '', $arraypart);
          $arraypart = preg_split('/(\s)/', $arraypart);
          $arraypart = array_diff($arraypart, array(''));
          $username = $arraypart[6];
          $userprofit = $arraypart[25];


          $sql_u = "SELECT * FROM wptj_users WHERE user_nicename='$username'";
            $result = $conn->query($sql_u);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $updatedprofit = $row['todayprofita'] + $userprofit;
              $finalprofit = number_format($updatedprofit, 2, '.', '');
              $sql = "UPDATE wptj_users SET todayprofita = ? WHERE user_nicename='$username';";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("s", $finalprofit);
              $stmt->execute();
        }
      }
    }
  }
}
     ?>

     <br>
     <form class="" action="includes/createrows.inc.php" method="post">
       <button type="submit" name="button"> Create rows for new users </button>
     </form>
     <br>
  <form class="" action="includes/addreferralamount.inc.php" method="post">
    <button type="submit" name="button"> Push referrals profits </button>
  </form>
  <br>
  <form class="" action="includes/todayprofit.inc.php" method="post">
    <button type="submit" name="button"> Push balances </button>
  </form>
  <br>
  <form class="" action="includes/senddayprofitmail.inc.php" method="post">
    <button type="submit" name="button"> Send day profit email </button>
  </form>
  <br>
  <form class="" action="includes/probended.inc.php" method="post">
    <button type="submit" name="button"> End prob period </button>
  </form>
  <br>
  <form class="" action="includes/daystostop.inc.php" method="post">
    <button type="submit" name="button"> Start prob and disable accounts </button>
  </form>
  <br>
  <form class="" action="includes/probmail.inc.php" method="post">
    <button type="submit" name="button"> Send prob start mails </button>
  </form>
  <br>
  <form class="" action="includes/checkstatisticprofit.inc.php" method="post">
    <button type="submit" name="button"> Check statistic profit </button>
  </form>


<br>
<br>
<br>


<form class="" action="qwertyamelisto123123ww.php" method="post">
  <p>Activate Bot for:</p>
  <input type="text" name="activateuser" autocomplete="off">
  <button type="submit" name="button">Submit</button>
</form>

<?php

if (isset($_POST['activateuser'])) {
  $usernamee = $_POST['activateuser'];
  $activebot = 2;
  $sql = "UPDATE wptj_users SET activebot = ? WHERE user_nicename = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("is", $activebot, $usernamee);
  $stmt->execute();
  mysqli_stmt_close($stmt);
  $sql_d = "SELECT * FROM wptj_users WHERE user_nicename='$usernamee'";
    $result = $conn->query($sql_d);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $touser = $row['user_email'];
      $subjectuser = "Starting bot in progress";
      $messageuser = "<h4>Hello " . $row['display_name'] . ". </h4>
      <p>Your bot is fully activated now. Enjoy your passive income. You may check more details in your Binance account.</p>
      <br>
      <p>Please contact us via Telegram support (@mrpnl) or email address if you have any questions. <br><br>
      <p style = 'opacity = 0.7;'> Sincerely <br> MR.PNL</p>";
      $headersuser = "Content-type: text/html\r\n";
      $headersuser .= "From: MR.PNL <support@mrpnl.com> \r\n";

      mail($touser, $subjectuser, $messageuser, $headersuser);
    }
  }
}

 ?>


  <br>

<?php

$currentdate = date ("d");
echo $currentdate;

 ?>

<br>
<br>
<br>
<form class="" action="includes/startbot2.php" method="post">
  <button type="submit" name="button"> Go bot </button>
</form>

<br>
<br>
<br>
<form class="" action="includes/startbot20.php" method="post">
  <button type="submit" name="button"> Go test bot </button>
</form>

<br>
<br>
<br>
<form class="" action="phpcheck/placeoneorder.php" method="post">
  <button type="submit" name="button"> Place one order </button>
</form>

<br>
<br>
<br>
<form class="" action="includes/killprocess.php" method="post">
  <button type="submit" name="button"> Kill process </button>
</form>

  </body>
</html>
