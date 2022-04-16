<?php

 function getUserInformation($userd, $tableName) {

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";
    include "/var/www/mrpnl.com/myaccount/includes/dbhstrategy.inc.php";

    $sql_dud = "SELECT * FROM wptj_users WHERE user_nicename = '{$userd}'";
      $resultdd = $conn->query($sql_dud);
      if ($resultdd->num_rows > 0) {
        while($rowasd = $resultdd->fetch_assoc()) {
          $tgchat  = $rowasd['telegramchat'];
          $curr = $rowasd['currentcurrency'];
          $fulldeposit = $rowasd['botdeposit'];
        }
    }

    $sql_4   = "SELECT * FROM `$userd` WHERE working='1'";
    $result4 = $connstr->query($sql_4);
    if ($result4->num_rows > 0) {
        while ($row4 = $result4->fetch_assoc()) {
          $ordersamount = $row4['ordersamount'];
          $pricedeviation = $row4['pricedeviation'];
          $takeprofit = $row4['takeprofit'];
          $martingale = $row4['martingale'];
          $pricemartin = $row4['pricemartin'];
          $newpricemartin = $row4['newpricemartin'];
          $liveadd = $row4['liveadd'];
          $smartdca = $row4['smartdca'];
          $firstorderdev = $row4['firstorderdev'];
        }
    }

    $sql_1 = "SELECT * FROM `$tableName` WHERE username = '{$userd}'";
      $result1 = $conn->query($sql_1);
      if ($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
          $price = $row1['startprice'];
          $mydeposit = $row1['dep'];
          $n = $row1['oni'];
          $one = $row1['one'];
        }
    }

    return array(
        $tgchat,
        $n,
        $one,
        $curr,
        $fulldeposit,
        $ordersamount,
        $mydeposit,
        $pricedeviation,
        $takeprofit,
        $martingale,
        $pricemartin,
        $newpricemartin,
        $liveadd,
        $smartdca,
        $firstorderdev,
        $price
    );

  }

  function setMain($i, $one, $nn, $solprice, $orderr, $order, $finalcoin, $userd, $api, $tableName, $ordersamount, $firstorderdev)
  {

    $minnn = 0;

    if ($nn == 1) {
      $minnn = 0.1;
    } elseif ($nn == 2) {
      $minnn = 0.01;
    } elseif ($nn == 3) {
      $minnn = 0.001;
    } elseif ($nn == 4) {
      $minnn = 0.0001;
    }

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

    $newWrapVar = 0;

    $sql_4   = "SELECT * FROM `$tableName` WHERE username='{$userd}'";
    $result4 = $conn->query($sql_4);
    if ($result4->num_rows > 0) {
        while ($row4 = $result4->fetch_assoc()) {
          $newWrapVar = $row4['wrapvar'];
        }
    }

    $currentPrice = $api->price("{$finalcoin}");

    $wrapVar = 0;
    ${"solprice" . $i} = $solprice - ($solprice/100*$orderr);
    ${"solpricee" . $i} = number_format(${"solprice" . $i}, $one, '.', '');

    if (${"solpricee" . $i} > $currentPrice) {
      ${"solprice" . $i} = $currentPrice - ($currentPrice/100*($firstorderdev/2*$i));
      ${"solpricee" . $i} = number_format(${"solprice" . $i}, $one, '.', '');
    }

    ${"quantity" . $i} = $order/${"solpricee" . $i};
    ${"quantityy" . $i} = number_format(${"quantity" . $i}, $nn, '.', '');

    $minnot = ${"solprice" . $i} * ${"quantityy" . $i};
    while ($minnot < 10) {
      ${"quantityy" . $i} = ${"quantityy" . $i} + $minnn;
      $minnot = ${"solprice" . $i} * ${"quantityy" . $i};
      $wrapVar++;
    }

    $finalwrap = $newWrapVar + $wrapVar;

    $sql = "UPDATE `$tableName` SET wrapvar = ? WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $finalwrap , $userd);
    $stmt->execute();

    if ($finalwrap !== 0 && $i == $ordersamount) {
      ${"quantityy" . $i} = ${"quantityy" . $i} - $minnn * $finalwrap;
      $newDealWrap = 0;
      $sql = "UPDATE `$tableName` SET wrapvar = ? WHERE username = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("is", $newDealWrap , $userd);
      $stmt->execute();
      mysqli_stmt_close($stmt);
    }

    try {
      ${"order" . $i} = $api->buy("{$finalcoin}", ${"quantityy" . $i}, ${"solpricee" . $i});
    } catch (\Exception $e) {
      $text1 = urlencode("Error on order placing spotted for ${userd} user. Bot disabled aslkda ${'quantityy' . $i} laksd;alskd");
      $text2 = $e->getMessage();
      $text = $text1 . $text2;
      $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
      file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=466212284&text=$text");
      $act = 0;
      $sql = "UPDATE wptj_users SET activebot = ? WHERE user_nicename = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("is", $act, $userd);
      $stmt->execute();
      mysqli_stmt_close($stmt);
      exit;
    }
    ${"finalorder" . $i} = serialize(${"order" . $i});
    $orderName = "order" . $i;
    $sql = "UPDATE `$tableName` SET `$orderName` = ? WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", ${"finalorder" . $i} , $userd);
    $stmt->execute();
    mysqli_stmt_close($stmt);

  }
