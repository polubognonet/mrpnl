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

    $sql_duda = "SELECT * FROM ordershelp WHERE username = '{$userd}'";
      $resultdda = $conn->query($sql_duda);
      if ($resultdda->num_rows > 0) {
        while($rowasda = $resultdda->fetch_assoc()) {
          $coin1 = $rowasda['coin1'];
          $n1 = $rowasda['on1'];
          $one1 = $rowasda['one1'];
          $coin2 = $rowasda['coin2'];
          $n2 = $rowasda['on2'];
          $one2 = $rowasda['one2'];
          $coin3 = $rowasda['coin3'];
          $n3 = $rowasda['on3'];
          $one3 = $rowasda['one3'];
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
          $mydeposit = $row1['dep'];
        }
    }

    return array(
        $tgchat,
        $coin1,
        $n1,
        $one1,
        $coin2,
        $n2,
        $one2,
        $coin3,
        $n3,
        $one3,
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
        $firstorderdev
    );

  }

  function setMain($i, $one, $nn, $solprice, $orderr, $order, $finalcoin, $userd, $api, $tableName, $ordersamount)
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

    $wrapVar = 0;
    ${"solprice" . $i} = $solprice - ($solprice/100*$orderr);
    ${"solpricee" . $i} = number_format(${"solprice" . $i}, $one, '.', '');
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


  function checkMoney($userd, $busdUser, $usdtUser, $bnbUser, $finalqtbnb, $mydeposit, $tgchat, $curr)
  {

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

    if ($curr == "busd" && $mydeposit > $busdUser) {
      $newActiveBot = 0;
      $sql_jh = "UPDATE wptj_users SET activebot = ? WHERE user_nicename = ?;";
      $stmt1 = $conn->prepare($sql_jh);
      $stmt1->bind_param("is", $newActiveBot, $userd);
      $stmt1->execute();
      if ($tgchat !== "0") {
          $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
          $text1 = urlencode(" Hello {$userd}! \n \n Unfortunately, your account has insufficient funds in order to proceed. Please top up your exchange balance. Bot is disabled.");
          file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$tgchat&text=$text1");
      }
      exit;
    }

    if ($curr == "usdt" && $mydeposit > $usdtUser) {
      $newActiveBot = 0;
      $sql_jh = "UPDATE wptj_users SET activebot = ? WHERE user_nicename = ?;";
      $stmt1 = $conn->prepare($sql_jh);
      $stmt1->bind_param("is", $newActiveBot, $userd);
      $stmt1->execute();
      if ($tgchat !== "0") {
          $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
          $text1 = urlencode(" Hello {$userd}! \n \n Unfortunately, your account has insufficient funds in order to proceed. Please top up your exchange balance. Bot is disabled.");
          file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$tgchat&text=$text1");
      }
      exit;
    }

    if ($curr == "usdt" && $bnbUser < $finalqtbnb) {
      $newActiveBot = 0;
      $sql_jh = "UPDATE wptj_users SET activebot = ? WHERE user_nicename = ?;";
      $stmt1 = $conn->prepare($sql_jh);
      $stmt1->bind_param("is", $newActiveBot, $userd);
      $stmt1->execute();
      if ($tgchat !== "0") {
          $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
          $text1 = urlencode(" Hello {$userd}! \n \n Unfortunately, your account has insufficient BNB in order to proceed and pay for the commision. Please top up your exchange balance. Bot is disabled.");
          file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$tgchat&text=$text1");
      }
      exit;
    }

  }
