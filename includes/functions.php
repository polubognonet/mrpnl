<?php

  function getUserInformation($userd)
  {

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

    $sql_dud = "SELECT * FROM wptj_users WHERE user_nicename = '{$userd}'";
      $resultdd = $conn->query($sql_dud);
      if ($resultdd->num_rows > 0) {
        while($rowasd = $resultdd->fetch_assoc()) {
          $curr = $rowasd['currentcurrency'];
          $mydeposit = $rowasd['botdeposit'];
          $tgchat = $rowasd['telegramchat'];
          $apikey  = $rowasd['api_key'];
          $apisec = $rowasd['api_secret'];
          $userid  = $rowasd['ID'];
          $trialStartedTime = $rowasd['trialfirststart'];
        }
    }

    return array(
        $curr,
        $mydeposit,
        $tgchat,
        $apikey,
        $apisec,
        $userid,
        $trialStartedTime,
    );

  }

  function getOrdersHelpDetails($userd)
  {

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

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

    return array(
        $coin1,
        $coin2,
        $coin3,
        $n1,
        $n2,
        $n3,
        $one1,
        $one2,
        $one3
    );

  }

  function getStrategyDetails($userd)
  {

    $en = 0;

    include "/var/www/mrpnl.com/myaccount/includes/dbhstrategy.inc.php";

    $sql_duda = "SELECT * FROM `$userd` WHERE working = '1'";
      $resultdda = $connstr->query($sql_duda);
      if ($resultdda->num_rows > 0) {
        $en = 1;
        while($rowasda = $resultdda->fetch_assoc()) {
          $coinsamount = $rowasda['coinsamount'];
          $ordersamount = $rowasda['ordersamount'];
          $pricedeviation = $rowasda['pricedeviation'];
          $takeprofit = $rowasda['takeprofit'];
          $martingale = $rowasda['martingale'];
          $pricemartin = $rowasda['pricemartin'];
          $newpricemartin = $rowasda['newpricemartin'];
          $liveadd = $rowasda['liveadd'];
          $smartdca = $rowasda['smartdca'];
          $firstorderdev = $rowasda['firstorderdev'];
        }
    }

    return array(
        $en,
        $coinsamount,
        $ordersamount,
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


  function checkTrial($userid, $trialStartedTime)
  {
    if ($trialStartedTime == "0" || $trialStartedTime == "") {

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

      $trialStarted = 1;
      $currentDay = date('Y-m-d H:i:s');
      $sql = "UPDATE wptj_users SET trialfirststart = ?, trialstarted = ? WHERE ID = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sis", $currentDay, $trialStarted, $userid);
      $stmt->execute();
      mysqli_stmt_close($stmt);
    }
  }

  function checkMoney($curr, $mydeposit, $busdUser, $usdtUser, $bnbUser, $finalqtbnb)
  {

    if ($curr == "busd" && $busdUser < $mydeposit) {
      header("Location: https://mrpnl.com/myaccount/dca/?busd=notenough");
      exit;
    }
    if ($curr == "usdt" && $usdtUser < $mydeposit) {
      header("Location: https://mrpnl.com/myaccount/dca/?usdt=notenough");
      exit;
    }
    if ($curr == "usdt" && $bnbUser < $finalqtbnb) {
      header("Location: https://mrpnl.com/myaccount/dca/?bnb=notenough");
      exit;
    }

  }




  function clearTables($trashHold, $trashHoldInt, $one1, $n1, $userd, $one2, $n2, $one3, $n3)
  {

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

    $sql = "UPDATE orders1 SET onumber = ?, oni = ?, one = ?, totalqt = ?, avgprice = ?, closeprice = ?, order1 = ?, order2 = ?, order3 = ?, order4 = ?, order5 = ?, order6 = ?, order7 = ?, order8 = ?, order9 = ?, o1 = ?, o2 = ?, o3 = ?, o4 = ?, o5 = ?, o6 = ?, o7 = ?, o8 = ?, o9 = ?, c = ?, orderprofit = ? WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssssssssssiiiiiiiiiiss", $trashHoldInt, $n1, $one1, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHold, $userd);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    $sql = "UPDATE orders2 SET onumber = ?, oni = ?, one = ?, totalqt = ?, avgprice = ?, closeprice = ?, order1 = ?, order2 = ?, order3 = ?, order4 = ?, order5 = ?, order6 = ?, order7 = ?, order8 = ?, order9 = ?, o1 = ?, o2 = ?, o3 = ?, o4 = ?, o5 = ?, o6 = ?, o7 = ?, o8 = ?, o9 = ?, c = ?, orderprofit = ? WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssssssssssiiiiiiiiiiss", $trashHoldInt, $n2, $one2, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHold, $userd);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    $sql = "UPDATE orders3 SET onumber = ?, oni = ?, one = ?, totalqt = ?, avgprice = ?, closeprice = ?, order1 = ?, order2 = ?, order3 = ?, order4 = ?, order5 = ?, order6 = ?, order7 = ?, order8 = ?, order9 = ?, o1 = ?, o2 = ?, o3 = ?, o4 = ?, o5 = ?, o6 = ?, o7 = ?, o8 = ?, o9 = ?, c = ?, orderprofit = ? WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssssssssssiiiiiiiiiiss", $trashHoldInt, $n3, $one3, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHold, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHoldInt, $trashHold, $userd);
    $stmt->execute();
    mysqli_stmt_close($stmt);
  }

  function setMain($i, $one1, $nn1, $solprice, $orderr, $order, $finalcoin, $userd, $api, $tableName)
  {

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

    ${"solprice" . $i} = $solprice - ($solprice/100*$orderr);
    // ${"pr" . $i} = round(${"solprice" . $i}, $one1);
    ${"solpricee" . $i} = number_format(${"solprice" . $i}, $one1, '.', '');
    ${"quantity" . $i} = $order/${"solpricee" . $i};
    // ${"quantityyy" . $i} = round(${"quantity" . $i}, $nn1);
    ${"quantityy" . $i} = number_format(${"quantity" . $i}, $nn1, '.', '');
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

  function setFinal($mydeposit, $finalcoin, $userd, $tableName, $solprice)
  {

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

    $sql = "UPDATE `$tableName` SET startprice = ?, dep = ?, coin = ? WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $solprice, $mydeposit, $finalcoin, $userd);
    $stmt->execute();
    mysqli_stmt_close($stmt);

  }

  function setFinalFinal($userd)
  {

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

    $botstatus = 2;
    $sql_v = "UPDATE wptj_users SET activebot = ? WHERE user_nicename = ?;";
    $stmt = $conn->prepare($sql_v);
    $stmt->bind_param("is", $botstatus, $userd);
    $stmt->execute();

  }

  function setDeposits($mydeposit, $userd, $tableName)
  {

    include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

    $sql_v = "UPDATE `$tableName` SET dep = ? WHERE username = ?;";
    $stmt = $conn->prepare($sql_v);
    $stmt->bind_param("ss", $mydeposit, $userd);
    $stmt->execute();

  }
