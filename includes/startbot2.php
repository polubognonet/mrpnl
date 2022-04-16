<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once "functions.php";

session_start();
include "dbh.inc.php";
include "userparsing.inc.php";

if (isset($_POST["startbutton"])) {
    $botstatus    = 2;
    $trialstarted = 1;
    $userd        = $user["user_nicename"];

    list($curr, $actualDeposit, $tgchat, $apikey, $apisec, $userid, $trialStartedTime) = getUserInformation($userd);
    list($coin1, $coin2, $coin3, $n1, $n2, $n3, $one1, $one2, $one3) = getOrdersHelpDetails($userd);
    list($en, $coinsamount, $ordersamount, $pricedeviation, $takeprofit, $martingale, $pricemartin, $newpricemartin, $liveadd, $smartdca, $firstorderdev) = getStrategyDetails($userd);
    checkTrial($userid, $trialStartedTime);

    if ($en == "0") {
      header("Location: https://mrpnl.com/myaccount/dca/?strategy=error");
      exit;
    }

    require "../checkorders/vendor/autoload.php";
    $api = new Binance\API("{$apikey}", "{$apisec}");

    $ticker   = $api->prices();
    $balances = $api->balances($ticker);
    $busdUser = $balances["BUSD"]["available"];
    $usdtUser = $balances["USDT"]["available"];
    $bnbUser  = $balances["BNB"]["available"];

    $pricebnb   = $api->price("BNBUSDT");
    $usdtbnb    = $actualDeposit * 0.01;
    $finalqtbnb = $usdtbnb / $pricebnb;

    checkMoney($curr, $actualDeposit, $busdUser, $usdtUser, $bnbUser, $finalqtbnb);

    $trashHold    = "0";
    $trashHoldInt = 0;

    $mydeposit = $actualDeposit / $coinsamount;

    for ($i = 1; $i <= $coinsamount; $i++) {
        $tableName = "orders" . $i;
        setDeposits($mydeposit, $userd, $tableName);
    }
    clearTables($trashHold, $trashHoldInt, $one1, $n1, $userd, $one2, $n2, $one3, $n3);

    if ($coinsamount == "1") {

        $mydeposit = $actualDeposit;
        $tableName = "orders1";

        $cointotrade = $coin1 . $curr;
        $finalcoin   = strtoupper($cointotrade);

        $price = $api->price("{$finalcoin}");

        $solprice = $price;

        $actualPriceMartin = $pricemartin;

        if ($smartdca == "1") {
            $actualPriceMartin = $newpricemartin;
        }

        $firstorder = ($mydeposit * ($martingale - 1)) / (pow($martingale, $ordersamount) - 1);
        $order1     = number_format($firstorder, 2, ".", "");

        for ($i = 2; $i <= $ordersamount; $i++) {
            $t = $i - 1;
            if ($i !== $ordersamount) {
                ${"order" . $i} = ${"order" . $t} * $martingale;
            } else {
                ${"order" . $i} = ${"order" . $t} * $martingale - 1;
            }
        }

        $orderr1 = $firstorderdev;
        $nn1     = $n1;

        for ($i = 2; $i <= $ordersamount; $i++) {
            ${"orderr" . $i} = ($orderr1 * (pow($actualPriceMartin, $i) - 1)) / ($actualPriceMartin - 1);
        }

        for ($i = 1; $i <= $ordersamount; $i++) {
            $orderr = ${"orderr" . $i};
            $order  = ${"order" . $i};
            setMain($i, $one1, $nn1, $solprice, $orderr, $order, $finalcoin, $userd, $api, $tableName);
        }

        setFinal($mydeposit, $finalcoin, $userd, $tableName, $solprice);

        for ($i = 1; $i <= $coinsamount; $i++) {
            $tableName = "orders" . $i;
            setDeposits($mydeposit, $userd, $tableName);
        }

        setFinalFinal($userd);

    } elseif ($coinsamount == "2") {

        $mydeposit = $actualDeposit / 2;
        $tableName = "orders1";

        $cointotrade = $coin1 . $curr;
        $finalcoin   = strtoupper($cointotrade);

        $price = $api->price("{$finalcoin}");

        $solprice = $price;

        $actualPriceMartin = $pricemartin;

        if ($smartdca == "1") {
            $actualPriceMartin = $newpricemartin;
        }

        $firstorder = ($mydeposit * ($martingale - 1)) / (pow($martingale, $ordersamount) - 1);
        $order1     = number_format($firstorder, 2, ".", "");

        for ($i = 2; $i <= $ordersamount; $i++) {
            $t = $i - 1;
            if ($i !== $ordersamount) {
                ${"order" . $i} = ${"order" . $t} * $martingale;
            } else {
                ${"order" . $i} = ${"order" . $t} * $martingale - 1;
            }
        }

        $orderr1 = $firstorderdev;
        $nn1     = $n1;

        for ($i = 2; $i <= $ordersamount; $i++) {
            ${"orderr" . $i} = ($orderr1 * (pow($actualPriceMartin, $i) - 1)) / ($actualPriceMartin - 1);
        }

        for ($i = 1; $i <= $ordersamount; $i++) {
            $orderr = ${"orderr" . $i};
            $order  = ${"order" . $i};
            setMain($i, $one1, $nn1, $solprice, $orderr, $order, $finalcoin, $userd, $api, $tableName);
        }

        setFinal($mydeposit, $finalcoin, $userd, $tableName, $solprice);

        $cointotrade2 = $coin2 . $curr;
        $finalcoin2   = strtoupper($cointotrade2);
        $tableName = "orders2";


        $price = $api->price("{$finalcoin2}");

        $solprice = $price;

        $actualPriceMartin = $pricemartin;

        if ($smartdca == "1") {
            $actualPriceMartin = $newpricemartin;
        }

        $firstorder = ($mydeposit * ($martingale - 1)) / (pow($martingale, $ordersamount) - 1);
        $order1     = number_format($firstorder, 2, ".", "");

        for ($i = 2; $i <= $ordersamount; $i++) {
            $t = $i - 1;
            if ($i !== $ordersamount) {
                ${"order" . $i} = ${"order" . $t} * $martingale;
            } else {
                ${"order" . $i} = ${"order" . $t} * $martingale - 1;
            }
        }

        $orderr1 = $firstorderdev;
        $nn2     = $n2;

        for ($i = 2; $i <= $ordersamount; $i++) {
            ${"orderr" . $i} = ($orderr1 * (pow($actualPriceMartin, $i) - 1)) / ($actualPriceMartin - 1);
        }

        for ($i = 1; $i <= $ordersamount; $i++) {
            $orderr = ${"orderr" . $i};
            $order  = ${"order" . $i};
            setMain($i, $one2, $nn2, $solprice, $orderr, $order, $finalcoin2, $userd, $api, $tableName);
        }

        setFinal($mydeposit, $finalcoin2, $userd, $tableName, $solprice);

        for ($i = 1; $i <= $coinsamount; $i++) {
            $tableName = "orders" . $i;
            setDeposits($mydeposit, $userd, $tableName);
        }

        setFinalFinal($userd);



    } elseif ($coinsamount == "3") {

        $mydeposit = $actualDeposit / 3;
        $tableName = "orders1";


        $cointotrade = $coin1 . $curr;
        $finalcoin   = strtoupper($cointotrade);

        $price = $api->price("{$finalcoin}");

        $solprice = $price;

        $actualPriceMartin = $pricemartin;

        if ($smartdca == "1") {
            $actualPriceMartin = $newpricemartin;
        }

        $firstorder = ($mydeposit * ($martingale - 1)) / (pow($martingale, $ordersamount) - 1);
        $order1     = number_format($firstorder, 2, ".", "");

        for ($i = 2; $i <= $ordersamount; $i++) {
            $t = $i - 1;
            if ($i !== $ordersamount) {
                ${"order" . $i} = ${"order" . $t} * $martingale;
            } else {
                ${"order" . $i} = ${"order" . $t} * $martingale - 1;
            }
        }

        $orderr1 = $firstorderdev;
        $nn1     = $n1;

        for ($i = 2; $i <= $ordersamount; $i++) {
            ${"orderr" . $i} = ($orderr1 * (pow($actualPriceMartin, $i) - 1)) / ($actualPriceMartin - 1);
        }

        for ($i = 1; $i <= $ordersamount; $i++) {
            $orderr = ${"orderr" . $i};
            $order  = ${"order" . $i};
            setMain($i, $one1, $nn1, $solprice, $orderr, $order, $finalcoin, $userd, $api, $tableName);
        }

        setFinal($mydeposit, $finalcoin, $userd, $tableName, $solprice);

        $tableName = "orders2";
        $cointotrade2 = $coin2 . $curr;
        $finalcoin2   = strtoupper($cointotrade2);

        $price = $api->price("{$finalcoin2}");

        $solprice = $price;

        $actualPriceMartin = $pricemartin;

        if ($smartdca == "1") {
            $actualPriceMartin = $newpricemartin;
        }

        $firstorder = ($mydeposit * ($martingale - 1)) / (pow($martingale, $ordersamount) - 1);
        $order1     = number_format($firstorder, 2, ".", "");

        for ($i = 2; $i <= $ordersamount; $i++) {
            $t = $i - 1;
            if ($i !== $ordersamount) {
                ${"order" . $i} = ${"order" . $t} * $martingale;
            } else {
                ${"order" . $i} = ${"order" . $t} * $martingale - 1;
            }
        }

        $orderr1 = $firstorderdev;
        $nn2     = $n2;

        for ($i = 2; $i <= $ordersamount; $i++) {
            ${"orderr" . $i} = ($orderr1 * (pow($actualPriceMartin, $i) - 1)) / ($actualPriceMartin - 1);
        }

        for ($i = 1; $i <= $ordersamount; $i++) {
            $orderr = ${"orderr" . $i};
            $order  = ${"order" . $i};
            setMain($i, $one2, $nn2, $solprice, $orderr, $order, $finalcoin2, $userd, $api, $tableName);
        }

        setFinal($mydeposit, $finalcoin2, $userd, $tableName, $solprice);

        $tableName = "orders3";
        $cointotrade3 = $coin3 . $curr;
        $finalcoin3   = strtoupper($cointotrade3);

        $price = $api->price("{$finalcoin3}");

        $solprice = $price;

        $actualPriceMartin = $pricemartin;

        if ($smartdca == "1") {
            $actualPriceMartin = $newpricemartin;
        }

        $firstorder = ($mydeposit * ($martingale - 1)) / (pow($martingale, $ordersamount) - 1);
        $order1     = number_format($firstorder, 2, ".", "");

        for ($i = 2; $i <= $ordersamount; $i++) {
            $t = $i - 1;
            if ($i !== $ordersamount) {
                ${"order" . $i} = ${"order" . $t} * $martingale;
            } else {
                ${"order" . $i} = ${"order" . $t} * $martingale - 1;
            }
        }

        $orderr1 = $firstorderdev;
        $nn3     = $n3;

        for ($i = 2; $i <= $ordersamount; $i++) {
            ${"orderr" . $i} = ($orderr1 * (pow($actualPriceMartin, $i) - 1)) / ($actualPriceMartin - 1);
        }

        for ($i = 1; $i <= $ordersamount; $i++) {
            $orderr = ${"orderr" . $i};
            $order  = ${"order" . $i};
            setMain($i, $one3, $nn3, $solprice, $orderr, $order, $finalcoin3, $userd, $api, $tableName);
        }

        setFinal($mydeposit, $finalcoin3, $userd, $tableName, $solprice);

        for ($i = 1; $i <= $coinsamount; $i++) {
            $tableName = "orders" . $i;
            setDeposits($mydeposit, $userd, $tableName);
        }

        setFinalFinal($userd);

    }

    if ($tgchat !== "0") {
        $token = "5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60";
        $text1 = urlencode(" Hello {$userd}! \n \n Your DCA bot has been enabled. \n \n Regards, Mr.PNL");
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$tgchat&text=$text1");
    }

    // shell_exec('php ../phpcheck/index.php 2>../phpcheck/phpchecklog.txt');
    // shell_exec('nohup nice -n 19 php ../phpcheck/index.php > ../phpcheck/phpchecklog.txt &');

    // header("Location: https://mrpnl.com/myaccount/phpcheck/index.php");
    header("Location: https://mrpnl.com/myaccount/index.php?start=success");
    echo "row inserted";
} elseif (isset($_POST["disablebutton"])) {
    $userd  = $user["user_nicename"];
    $userid = $user["ID"];

    $botstatus = 0;
    $sql       = "UPDATE wptj_users SET activebot = ? WHERE ID = ?;";
    $stmt      = $conn->prepare($sql);
    $stmt->bind_param("ii", $botstatus, $userid);
    $stmt->execute();

    $onew = "0";

    $sqlgd = "UPDATE orders1 SET coin = ?, o1 = ?, o2 = ?, o3 = ?, o4 = ?, o5 = ?, o6 = ?, o7 = ?, o8 = ?, o9 = ?, totalqt = ?, avgprice = ?, onumber = ?, orderprofit = ? WHERE username = '{$userd}';";
    $stmt  = $conn->prepare($sqlgd);
    $stmt->bind_param("ssssssssssssss", $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew);
    $stmt->execute();

    $sqlg = "UPDATE orders2 SET coin = ?, o1 = ?, o2 = ?, o3 = ?, o4 = ?, o5 = ?, o6 = ?, o7 = ?, o8 = ?, o9 = ?, totalqt = ?, avgprice = ?, onumber = ?, orderprofit = ? WHERE username = '{$userd}';";
    $stmt = $conn->prepare($sqlg);
    $stmt->bind_param("ssssssssssssss", $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew);
    $stmt->execute();

    $sqlga = "UPDATE orders3 SET coin = ?, o1 = ?, o2 = ?, o3 = ?, o4 = ?, o5 = ?, o6 = ?, o7 = ?, o8 = ?, o9 = ?, totalqt = ?, avgprice = ?, onumber = ?, orderprofit = ? WHERE username = '{$userd}';";
    $stmt  = $conn->prepare($sqlga);
    $stmt->bind_param("ssssssssssssss", $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew, $onew);
    $stmt->execute();

    $touser      = $user["user_email"];
    $subjectuser = "Bot is disabled";
    $messageuser = "<h4>Hello " . $user["display_name"] . ". </h4>
    <p>Your bot is disabled now per your request.</p>
    <br>
    <p>If you have not disabled it, please contact us right now via Telegram support (@mrpnl) or email address. <br><br>
    <p style = 'opacity = 0.7;'> Sincerely <br> MR.PNL</p>";
    $headersuser = "Content-type: text/html\r\n";
    $headersuser .= "From: MR.PNL <support@mrpnl.com> \r\n";

    mail($touser, $subjectuser, $messageuser, $headersuser);

    if ($tgchat !== "0") {
        $token = "5085832702:AAEfkoomATttW-kmhVkZrHc8U3owKpm4H60";
        $text1 = urlencode(" Dear {$userd}. \n \n Your DCA bot has been disabled. \n \n Regards, Mr.PNL");
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$tgchat&text=$text1");
    }

    header("Location: https://mrpnl.com/myaccount/index.php?disable=success");
    echo "row inserted";
}

?>
