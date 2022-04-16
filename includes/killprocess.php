<?php

include 'dbh.inc.php';
include 'userparsing.inc.php';


 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

    $pid = 0;

    $sql_u = "SELECT * FROM ordershelp WHERE username ='sororoka'";
      $result = $conn->query($sql_u);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $pid = $row['pid'];
        }
}

    exec("kill -9 $pid");

    header("Location: https://mrpnl.com/myaccount/qwertyamelisto123123ww.php?asd=good");

     ?>
  </body>
</html>
