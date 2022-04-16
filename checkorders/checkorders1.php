<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

require_once("functions.php");
require_once 'vendor/autoload.php';

$dbServername = "localhost";
$dbUsername   = "root";
$dbPassword   = "Polubognonet1!";
$dbName       = "wordpress";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);


for ($i=1; $i <= 3; $i++) {
$sql_du  = "SELECT * FROM wptj_users WHERE activebot = '2' AND coinsnum = '${i}'";
$resultd = $conn->query($sql_du);
if ($resultd->num_rows > 0) {
    while ($rowas = $resultd->fetch_assoc()) {
    // CHECK EACH USER
        $d = $rowas['coinsnum'];
        $breakme4 = false;
        for ($h=1; $h <= $d; $h++) {
        // CHECK EACH COIN
        $tableName  = "orders" . $h;
        $usernamik = $rowas['user_nicename'];
        list($userapi, $userkey, $curr, $tgchat, $user_telegramdeals, $user_balance, $finalcoin, $totalqt, $onumber, $n, $ne, $takeprofit, $orderprofit, $profitorderrr, $currcof, $prevcof, $mydeposit, $fullDeposit, $takeProfitDev, $ordernumber, $smartDca, $liveadd, $pullup, $dynamictp) = getUserDetails($usernamik, $tableName);
        $sql_u  = "SELECT * FROM `$tableName` WHERE username='{$usernamik}'";
        $result = $conn->query($sql_u);
        $breakme = false;
        $breakme2 = false;
        $breakme3 = false;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $api = new Binance\API("{$userapi}", "{$userkey}");
                require_once("class.php");
                try {
                  $currentPrice = $api->price("{$finalcoin}");
                } catch (\Exception $e) {
                  if ($tgchat !== "0") {
                      $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
                      $text1 = urlencode("Hello {$usernamik}! \n \nCannot check price for {$finalcoin} . Error message:" . $e->getMessage());
                      file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$tgchat&text=$text1");
                  }
                }

                $nor = 2;

                for ($i = 1; $i <= $ordernumber; $i++) {
                    $orderName      = "order" . $i;
                    $oName          = "o" . $i;
                    ${"order" . $i} = $row["{$orderName}"];
                    ${"o" . $i}     = $row["{$oName}"];
                    try {
                      list(${"orderrr" . $i}, ${"price" . $i}, ${"symbol" . $i}, $nor) = sortOrders(${"order" . $i}, $api);
                    } catch (\Exception $e) {

                    }
                    if ($nor == "0") {
                      $dealCancelled1 = disableCancelledBot($nor, $usernamik);
                      $dealCancelled2 = sendCancelledBot($nor, $tgchat, $usernamik);
                      $breakme = true;
                      $breakme3 = true;
                      $breakme4 = true;
                      break;
                    }
                }

                $dealCloseOrder = $row["orderprofit"];
                if (!$dealCloseOrder || !isset($dealCloseOrder) || $dealCloseOrder == "N;") {
                  setPartialExOrder($dealCloseOrder, $tableName, $totalqt, $ne, $api, $usernamik);
                } else {
                  try {
                    echo $dealCloseOrder;
                    list($dealProfitOrder, $dealProfitOrderPrice, $dealProfitOrderSymbol, $nor) = sortOrders($dealCloseOrder, $api);
                  } catch (\Exception $e) {

                  }
                }
                if ($nor == "0") {
                  $dealCancelled1 = disableCancelledBot($nor, $usernamik);
                  $dealCancelled2 = sendCancelledBot($nor, $tgchat, $usernamik);
                  $breakme = true;
                  $breakme3 = true;
                  $breakme4 = true;
                }

                if ($breakme == true) {
                  break;
                }

                $orders = $api->orders("{$finalcoin}", $orderrr1);

                foreach ($orders as $orderpart) {
                //CHECK EACH ORDER

                    if ($orderpart['status'] == "FILLED" && $orderpart['type'] == "LIMIT") {

                        $qt = $orderpart['executedQty'];
                        $cp = $orderpart['price'];

                        if ($orderpart['orderId'] == $profitorderrr && $orderpart['status'] == "FILLED") {

                          unset($dealCancelled1);
                          unset($dealCancelled2);
                          $execcprice = $orderpart['price'];

                            list($currentqt, $currentavg, $onn) = getDealInformation($usernamik, $tableName);

                            $currentprofit = $orderpart['executedQty'] * $orderpart['price'] - $currentqt * $currentavg;

                            $finalprofit   = round($currentprofit, 2);


                            $oz = $ordernumber;

                            for ($i = 1; $i <= $ordernumber; $i++) {
                                if (${'o' . $i} == "0") {
                                    $response = $api->cancel("{$finalcoin}", ${'orderrr' . $i});
                                    $oz = $oz - 1;
                                }
                            }

                            $onew       = 0;
                            $dealNumber = 0;

                            for ($i = 1; $i <= $ordernumber; $i++) {
                                $oNameReal = "o" . $i;
                                $sqlgd     = "UPDATE `$tableName` SET `$oNameReal` = ?, totalqt = ?, avgprice = ?, closeprice = ?, onumber = ?, orderprofit = ? WHERE username = '{$usernamik}';";
                                $stmt      = $conn->prepare($sqlgd);
                                $stmt->bind_param("isssis", $onew, $onew, $onew, $onew, $onew, $onew);
                                $stmt->execute();
                            }

                            calculateTodayProfit($usernamik, $finalprofit);
                            $dealNumber = calculateDealNumber($usernamik);
                            addHistoryRecord($usernamik, $finalprofit, $finalcoin, $dealNumber, $oz, $ordernumber, $execcprice);


                            if ($liveadd == "1") {
                                calcLiveAdd($usernamik, $finalprofit, $mydeposit, $tableName, $fullDeposit);
                            }

                            calcBalance($usernamik, $finalprofit, $user_balance);

                            if ($tgchat !== "0" && $user_telegramdeals == "1") {
                                $token = '5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60';
                                $text1 = urlencode("Hello {$usernamik}! \n \nMR.PNL deal report: \n \nDeal № {$dealNumber} is closed. \nProfit: $" . $finalprofit . " \nCoin: {$finalcoin}. \nPrice: {$execcprice}. \nOrders executed: {$oz}/{$ordernumber}. \n \nStarting new deal.");
                                file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$tgchat&text=$text1");
                            }

                            shell_exec('php /var/www/mrpnl.com/myaccount/includes/startbot21.php "' . $userapi . '" "' . $userkey . '" "' . $usernamik . '" "' . $h . '" >> /var/www/mrpnl.com/myaccount/checkorders/checklogissues.log 2>&1 &');
                            $breakme2 = true;
                            $breakme3 = true;
                            break;
                        }

                        for ($i = 1; $i <= $ordernumber; $i++) {
                            $orderName = ${"orderrr" . $i};
                            $oName     = ${"o" . $i};
                            $oRowName  = "o" . $i;
                            $dynamicresult = 0;
                            if ($dynamictp == "0") {
                              $dynamicresult = 0;
                            } else {
                              $dynamicresult = $takeprofit / $ordernumber;
                            }

                            $actualtakeprofit = $dynamicresult * $i + $takeProfitDev;

                            if ($orderpart['orderId'] == $orderName && $oName == "0") {
                                checkOrders($orderName, $i, $usernamik, $qt, $cp, $n, $ne, $oRowName, $finalcoin, $api, $tableName, $actualtakeprofit);
                            }
                        }

                    }

                }

                setDealCloseOrder($usernamik, $finalcoin, $api, $tableName);

                if ($breakme2 == true) {
                  break;
                }

                $priceDifference = $currentPrice - $price1;
                $finalDifference = $priceDifference / ($price1 / 100);

                if ($o1 == "0" && $pullup !== "0" && $finalDifference > $pullup) {

                  unset($dealCancelled1);
                  unset($dealCancelled2);
                    for ($i = 1; $i <= $ordernumber; $i++) {
                        if (${'o' . $i} == "0") {
                            $response = $api->cancel("{$finalcoin}", ${'orderrr' . $i});
                        }
                    }

                    shell_exec('php /var/www/mrpnl.com/myaccount/includes/startbot21.php "' . $userapi . '" "' . $userkey . '" "' . $usernamik . '" "' . $h . '" >> /var/www/mrpnl.com/myaccount/checkorders/checklogissues.log 2>&1 &');
                    break;
                }

                if ($currcof !== $prevcof) {
                  for ($i = 1; $i <= $ordernumber; $i++) {
                      if (${'o' . $i} == "0") {
                          $response = $api->cancel("{$finalcoin}", ${'orderrr' . $i});
                      }
                    }

                  $newonumber = $onumber + 1;
                  shell_exec('php /var/www/mrpnl.com/myaccount/includes/startbot22.php "' . $userapi . '" "' . $userkey . '" "' . $usernamik . '" "' . $h . '" "' . $newonumber . '" "' . $finalcoin . '" >> /var/www/mrpnl.com/myaccount/checkorders/smartdcaissues.log 2>&1 &');

                }
            }
        }
        if ($breakme3 == true) {
          break;
        }
    }
    $sqlgd     = "UPDATE ordershelp SET prevcof = ? WHERE username = '{$usernamik}';";
    $stmt      = $conn->prepare($sqlgd);
    $stmt->bind_param("s", $currcof);
    $stmt->execute();
    if ($breakme4 == true) {
      break;
    }
    }
}
}


?>
