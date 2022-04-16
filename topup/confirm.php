<?php

session_start();
include '../includes/dbh.inc.php';
include '../includes/dbhstrategy.inc.php';
include '../includes/dbhhistory.inc.php';
include '../includes/dbhapi.inc.php';
include '../includes/userparsing.inc.php';


if (!isset($user['user_login'])) {
  header("Location: https://mrpnl.com/login/");
  exit();

}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/input.css">
    <link rel="stylesheet" href="../css/icons.css">
    <link rel="stylesheet" href="css/stylestat.css">
    <link rel="stylesheet" href="../css/mobilestyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link
  rel="stylesheet" type="text/css"
  href="//cdn.jsdelivr.net/gh/loadingio/ldbutton@v1.0.1/dist/ldbtn.min.css"
/>
    <link rel="icon" type="image/png" href="../favicon32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../favicon16.png" sizes="16x16" />
    <script type="text/javascript" src="../js/functions.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
    <script src="https://cdn.statically.io/gh/kswedberg/jquery-smooth-scroll/3948290d/jquery.smooth-scroll.min.js"></script>
  </head>

  <body>
    <div class="loader-wrapper">
      <div class="loader"></div>
    </div>
  <div class="wwrapper">
    <?php
    include "header.php";
     ?>
    <div class="wrapper">
      <?php include "currencyinfo1.php"; ?>
      <?php include "helloworld.php"; ?>
      <div class="banners">
        <img src="img/topupbanner.png" alt="">
      </div>
      <div class="hellomobile">
        <p>TOP UP</p>
      </div>
      <div class="topupwrap">
        <div class="depositoptions">
          <div class="topupheader">
            <p>WE ACCEPT</p>
          </div>
          <div class="topupbody">
          <div class="topupspacer2">
          </div>
          <div class="coinswrap">
            <div id="coin1" class="coinwrapper">
              <div class="coinimg">
                <img src="img/usdtimg.png" alt="">
              </div>
              <p>USDT</p>
            </div>
            <div id="coin2" class="coinwrapper">
              <div class="coinimg">
                <img src="img/btcimg.png" alt="">
              </div>
              <p>BTC</p>
            </div>
            <div id="coin3" class="coinwrapper">
              <div class="coinimg">
                <img src="img/ethimg.png" alt="">
              </div>
              <p>ETH</p>
            </div>
            <div id="coin4" class="coinwrapper">
              <div class="coinimg">
                <img src="img/ltcimg.png" alt="">
              </div>
              <p>LTC</p>
            </div>
          </div>
          <div class="topupspacer1">
          </div>
          <div class="coinswrapdesk">
              <p>We are not using your personal information. You can be sure that any data entered is absolutely safe. Click here to check our <strong><a href="https://mrpnl.com/en/privacypolicy/">Privacy Policy</a></strong>.</p>
          </div>
          <div class="mrpnllogotopup">
            <p>MR.PNL</p>
          </div>
          </div>
        </div>
        <div class="containertopup">
          <div class="containerheader">
              <p>CONFIRM DEPOSIT</p>
            </div>
            <div class="containerbody">
            <div class="topupinformation">
              <?php
                    if ($_POST['amount']<5) {
                      echo "<div class='finaldeposit' style='color:darkred;'>
                          <p>Deposit:</p>
                          <p>$" . $_POST['amount'] . "</p>
                        </div>";
                    } else {
                      echo "<div class='finaldeposit'>
                          <p>Deposit:</p>
                          <p>$" . $_POST['amount'] . "</p>
                        </div>";
                    }
               ?>
              <div class="emailinformation">
                <p>Email address:</p>
                <?php echo "<p>" . $user['user_email'] . "</p>" ?>
              </div>
            </div>
            <form  class="paymentform" name="payment" method="post" action="https://sci.any.money/invoice" accept-charset="UTF-8">
              <?php include "../includes/pay.inc.php"; ?>
              <?php foreach ($res as $k=> $v): ?>
                <input type="hidden" name="<?= $k; ?>" value="<?= $v; ?>"/>
              <?php endforeach; ?>
              <?php

              if ($_POST['amount']<5) {
                echo "<input class='btn' type='button' onclick='badinputTopUP() value='CONFIRM'>";
              } else {
                echo "<input class='btn' type='submit' value='CONFIRM'>";
              }
               ?>
            </form>
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <div class="animationtop">
              <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_jlbcllvd.json"  background="transparent"  speed="1"  style="width: 30%; height: 100%;"  loop  autoplay></lottie-player>
            </div>
          </div>
          </div>

        </div>
      </div>
    </div>
    <?php include "footer.php"; ?>
  </div>
</body>

</html>
