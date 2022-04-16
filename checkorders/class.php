<?php

class OrdersSort
{

    public function getUserDetails($usernamik, $tableName)
    {
        include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";
        include "/var/www/mrpnl.com/myaccount/includes/dbhstrategy.inc.php";

        $sql_1   = "SELECT * FROM wptj_users WHERE user_nicename='{$usernamik}'";
        $result1 = $conn->query($sql_1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $userapi = $row1['api_key'];
                $userkey = $row1['api_secret'];
                $curr    = $row1['currentcurrency'];
                $tgchat  = $row1['telegramchat'];
            }
        }

        $sql_2   = "SELECT * FROM `$tableName` WHERE username='{$usernamik}'";
        $result2 = $conn->query($sql_2);
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $finalcoin = $row2['coin'];
                $onumber = $row2['onumber'];
                $n         = $row2['one'];
                $ne        = $row2['oni'];
                $mydeposit = $row2['dep'];
                $takeprofit    = $row2['orderprofit'];
                if ($takeprofit !== "0") {
                  $orderprofit   = unserialize($takeprofit);
                  $profitorderrr = $orderprofit['orderId'];
                } else {
                  $orderprofit   = 0;
                  $profitorderrr = 0;
                }
            }
        }

        $sql_3   = "SELECT * FROM ordershelp WHERE username='{$usernamik}'";
        $result3 = $conn->query($sql_3);
        if ($result3->num_rows > 0) {
            while ($row3 = $result3->fetch_assoc()) {
                $currcof = $row3['cof'];
                $prevcof = $row3['prevcof'];
            }
        }

        $sql_4   = "SELECT * FROM `$usernamik` WHERE working='1'";
        $result4 = $connstr->query($sql_4);
        if ($result4->num_rows > 0) {
            while ($row4 = $result4->fetch_assoc()) {
                $takeProfitDev = $row4['takeprofit'];
                $fullDeposit = $row4['deposit'];
                $ordernumber = $row4['ordersamount'];
                $pricemartin = $row4['pricemartin'];
                $smartDca = $row4['smartdca'];
                $liveadd = $row4['liveadd'];
                $pullup = $row4['pullupgrid'];
                $dynamictp = $row4['dynamictp'];
            }
        }

        return array(
            $userapi,
            $userkey,
            $curr,
            $tgchat,
            $finalcoin,
            $onumber,
            $n,
            $ne,
            $takeprofit,
            $orderprofit,
            $profitorderrr,
            $currcof,
            $prevcof,
            $mydeposit,
            $fullDeposit,
            $takeProfitDev,
            $ordernumber,
            $smartDca,
            $liveadd,
            $pullup,
            $dynamictp
        );

    }


}


class OrdersCheck
{

    public $nor;

    public function sortOrders($order, $api)
    {
        $nor = 1;
        if ($order !== "0") {
        $result  = unserialize($order);
        $orderrr = $result['orderId'];
        $price   = $result['price'];
        $symbol  = $result['symbol'];

        try {
            $orderstatus = $api->orderStatus($symbol, $orderrr);
            if ($orderstatus['status'] == "CANCELED") {
                $nor = 0;
            }
          }
        catch (Exception $e) {

        }
        return array(
            $orderrr,
            $price,
            $symbol,
            $nor
        );
        }
    }

    public function checkOrders($order, $i, $usernamik, $qt, $cp, $n, $ne, $on, $finalcoin, $api, $tableName, $actualtakeprofit)
    {

        include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";


        $sql_j    = "SELECT * FROM `$tableName` WHERE username='{$usernamik}'";
        $resultss = $conn->query($sql_j);
        if ($resultss->num_rows > 0) {
            while ($rowss = $resultss->fetch_assoc()) {
                $currentqt     = $rowss['totalqt'];
                $currentavg    = $rowss['avgprice'];
            }
        }

        $newtotalqt = $currentqt + $qt;
        $avgprice   = ($currentqt * $currentavg + $qt * $cp) / ($currentqt + $qt);


        $done    = 1;
        $sql_v   = "UPDATE `$tableName` SET `$on` = ?, onumber = ? WHERE username = '{$usernamik}';";
        $stmt    = $conn->prepare($sql_v);
        $stmt->bind_param("ii", $done, $i);
        $stmt->execute();

        $quantity = $newtotalqt;
        $finalqua = number_format($quantity, $ne, '.', '');

        $actualpricemartin = 100 + $actualtakeprofit;
        $finalpricemartin = $actualpricemartin / 100;

        $price   = $avgprice * $finalpricemartin;
        $finalp1 = round($price, $n);
        $finalp  = number_format($finalp1, $n, '.', '');



        $c = 1;

        $sql_m = "UPDATE `$tableName` SET totalqt = ?, avgprice = ?, closeprice = ?, c = ? WHERE username = '{$usernamik}';";
        $stmt  = $conn->prepare($sql_m);
        $stmt->bind_param("sssi", $finalqua, $avgprice, $finalp, $c);
        $stmt->execute();

      }

    public function setDealCloseOrder($usernamik, $finalcoin, $api, $tableName)
    {

      include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";


      $sql_j    = "SELECT * FROM `$tableName` WHERE username='{$usernamik}'";
      $resultss = $conn->query($sql_j);
      if ($resultss->num_rows > 0) {
          while ($rowss = $resultss->fetch_assoc()) {
              $takeprofit    = $rowss['orderprofit'];
              if ($takeprofit !== "" || $takeprofit !== "0" || $takeprofit !== 0 || !isset($takeprofit)) {
                $result  = unserialize($takeprofit);
                $profitorderrr = $result['orderId'];
              }
              $c = $rowss['c'];
          }
      }

      if ($c !== "0") {
      if ($profitorderrr !== "" || $profitorderrr !== "0") {
        try {
              $orderstatus = $api->orderStatus("{$finalcoin}", $profitorderrr);
              $orderstatus1 = $orderstatus['status'];
              $orderexecqt = $orderstatus['executedQty'];

              if ($orderstatus1 !== "CANCELED" || $orderstatus1 !== "CANCELLED" || $orderstatus1 !== "PARTIALLY_FILLED")  {
                  $response = $api->cancel("{$finalcoin}", $profitorderrr);
                } elseif ($orderstatus1 == "PARTIALLY_FILLED") {
                  $currentikqt = 0;
                  $sql_fg    = "SELECT * FROM `$tableName` WHERE username='{$usernamik}'";
                  $resultsas = $conn->query($sql_fg);
                  if ($resultsas->num_rows > 0) {
                      while ($rowass = $resultsas->fetch_assoc()) {
                          $currentikqt     = $rowass['totalqt'];
                      }
                  }
                  $finalQTQT = $currentikqt - $orderexecqt;
                  $sql_v   = "UPDATE `$tableName` SET totalqt = ? WHERE username = '{$usernamik}';";
                  $stmt    = $conn->prepare($sql_v);
                  $stmt->bind_param("s", $finalQTQT);
                  $stmt->execute();

                  $response = $api->cancel("{$finalcoin}", $profitorderrr);

                } } catch (\Exception $e) {
                  echo $e->getMessage();
                }

            }

            $finalqua = 0;
            $finalp = 0;

            $sql_dd    = "SELECT * FROM `$tableName` WHERE username='{$usernamik}'";
            $resultsds = $conn->query($sql_dd);
            if ($resultsds->num_rows > 0) {
                while ($rowsds = $resultsds->fetch_assoc()) {
                    $finalqua    = $rowsds['totalqt'];
                    $finalp    = $rowsds['closeprice'];
                }
            }

      try {
        $order          = $api->sell("{$finalcoin}", $finalqua, $finalp);
      } catch (\Exception $e) {
        $text1 = urlencode("Take Profit Order cannot be set for {$usernamik}!");
        $text2 = $e->getMessage();
        $text = $text1 . $text2;
        $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=466212284&text=$text");
        $disabledbot = 0;
        $sqlas = "UPDATE wptj_users SET activebot = ? WHERE user_nicename = '$usernamik';";
        $stmt1 = $conn->prepare($sqlas);
        $stmt1->bind_param("i", $disabledbot);
        $stmt1->execute();
      }

      $finalordersell = serialize($order);

      $newc = 0;

      $sql_d = "UPDATE `$tableName` SET orderprofit = ?, c = ? WHERE username = '{$usernamik}';";
      $stmt  = $conn->prepare($sql_d);
      $stmt->bind_param("si", $finalordersell, $newc);
      $stmt->execute();

    }
  }



}

class Smartdca
{


}

class ExceptionHandlers
{

    public function disableCancelledBot($nor, $usernamik)
    {
        include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";
        if ($nor == "0") {
            $sqlas = "UPDATE wptj_users SET activebot = ? WHERE user_nicename = '$usernamik';";
            $stmt1 = $conn->prepare($sqlas);
            $stmt1->bind_param("i", $nor);
            $stmt1->execute();
        }
    }

    public function sendCancelledBot($nor, $tgchat, $usernamik)
    {
        if ($tgchat !== "0" && $nor == "0") {
            $dadate = date("Y/m/d h:i:sa");
            $token  = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
            $text1  = urlencode("Dear {$usernamik}. \n \n It appears that one of your orders has been cancelled. Please note that it is not permitted to cancel orders manually. Your DCA bot is disabled now. Some orders could be still placed on the exchange side. \n \n Regards, Mr.PNL");
            file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$tgchat&text=$text1");
            exit;
        }
    }

}

class ClosedDeal
{

    public function getDealInformation($usernamik, $tableName)
    {
        include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";

        $sql_j9    = "SELECT * FROM `$tableName` WHERE username='{$usernamik}'";
        $resultss9 = $conn->query($sql_j9);
        if ($resultss9->num_rows > 0) {
            while ($rowss9 = $resultss9->fetch_assoc()) {
                $currentqt     = $rowss9['totalqt'];
                $currentavg    = $rowss9['avgprice'];
                $onn           = $rowss9['onumber'];

            }
        }

        return array(
            $currentqt,
            $currentavg,
            $onn
        );

    }

    public function calculateTodayProfit($usernamik, $finalprofit)
    {

        include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";
        $sql_ca    = "SELECT * FROM wptj_users WHERE user_nicename='{$usernamik}';";
        $resultasd = $conn->query($sql_ca);
        if ($resultasd->num_rows > 0) {
            while ($rowasd = $resultasd->fetch_assoc()) {
                $updatedprofit = $rowasd['todayprofita'] + $finalprofit;
                $sql_asd       = "UPDATE wptj_users SET todayprofita = ? WHERE user_nicename='{$usernamik}';";
                $stmt          = $conn->prepare($sql_asd);
                $stmt->bind_param("s", $updatedprofit);
                $stmt->execute();
            }
        }

    }

    public function calculateDealNumber($usernamik)
    {

        $dealNumber = 0;

        include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";
        $sql_1   = "SELECT * FROM ordershelp WHERE username='polubognonet';";
        $result1 = $conn->query($sql_1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $randNum    = rand(1, 100);
                $dealNumber = $row1['dealnumber'] + $randNum;
                $sql        = "UPDATE ordershelp SET dealnumber = ? WHERE username='polubognonet';";
                $stmt       = $conn->prepare($sql);
                $stmt->bind_param("i", $dealNumber);
                $stmt->execute();
            }
        }

        return $dealNumber;

    }

    public function addHistoryRecord($usernamik, $finalprofit, $finalcoin, $dealNumber, $oz, $ordernumber, $execcprice)
    {

        include "/var/www/mrpnl.com/myaccount/includes/dbhhistory.inc.php";

        $currdate = date("Y-m-d H:i:s");
        $currdatewrap = date('H:i:s m-d-Y');
        $orders = $oz . "/" . $ordernumber;

        $coinname = substr($finalcoin, 0, -4);
        $coinnamelength = strlen($coinname);
        $currname = substr($finalcoin, $coinnamelength);
        $newFinalCoin = $coinname . "-" . $currname;

        $sql = "INSERT INTO `$usernamik` (dealid, coin, profit, orders, timecurr, datecurr, execprice) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmte = $connhistory->prepare($sql);
        $stmte->bind_param("sssssss", $dealNumber, $newFinalCoin, $finalprofit, $orders, $currdatewrap, $currdate, $execcprice);
        $stmte->execute();

    }

    public function calcLiveAdd($usernamik, $finalprofit, $mydeposit, $tableName, $fullDeposit)
    {

        $currentDeposit2 = 0;

        include "/var/www/mrpnl.com/myaccount/includes/dbh.inc.php";
        include "/var/www/mrpnl.com/myaccount/includes/dbhstrategy.inc.php";

        $sql_1   = "SELECT * FROM wptj_users WHERE user_nicename='{$usernamik}';";
        $result1 = $conn->query($sql_1);
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $currentDeposit2 = $row['botdeposit'] + $finalprofit;
            }
        }

        $sql_2 = "UPDATE wptj_users SET botdeposit = ? WHERE user_nicename = '{$usernamik}';";
        $stmt  = $conn->prepare($sql_2);
        $stmt->bind_param("s", $currentDeposit2);
        $stmt->execute();

        $newdeposit = $mydeposit + $finalprofit;
        $newFullDeposit = $fullDeposit + $finalprofit;

        $sql_3 = "UPDATE `$usernamik` SET deposit = ? WHERE working = '1';";
        $stmt  = $connstr->prepare($sql_3);
        $stmt->bind_param("s", $newFullDeposit);
        $stmt->execute();

        $sql_4 = "UPDATE `$tableName` SET dep = ? WHERE username = ?;";
        $stmt  = $conn->prepare($sql_4);
        $stmt->bind_param("ss", $newdeposit, $usernamik);
        $stmt->execute();

    }

}


?>
