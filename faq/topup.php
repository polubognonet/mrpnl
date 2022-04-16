<?php

session_start();
include '../includes/dbh.inc.php';
include '../includes/userparsing.inc.php';

if (!isset($user['user_login'])) {
  header("Location: https://mrpnl.com/en/login-2/");
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
    <link rel="stylesheet" href="../css/mobilestyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../favicon32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../favicon16.png" sizes="16x16" />
    <script type="text/javascript" src="js/functions.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  </head>
  <body>
    <body>
    <div class="wwrapper">
      <?php
      include "../header.php";
       ?>
      <div class="wrappertopicapi">
        <?php include "../currencyinfo1.php"; ?>
        <?php include "../helloworld.php"; ?>
        <div class="phverify" style="margin-top: 150px;">
          <div class="phonenumberheader" style="display: flex;">
            <a href="https://mrpnl.com/myaccount/howto.php"><img src="../img/back.png" alt=""></a>
            <div class="mainheader">
              <h3>How to top up balance?</h3>
            </div>
          </div>
          <div class="maintopic">
          <p><strong>Top up</strong> your balance in less than 10 minutes! Do it <strong>safely</strong> with cryptocurrency transfers!</p>
          <br>
          <br>
          <p>First of all, you need enter the required amount on the <strong><a href="https://mrpnl.com/myaccount/topup.php">Top up</a></strong> page:</p>
          <br>
          <img src="../img/topup1.png" alt="">
          <br>
          <br>
          <br>
          <p>Please note that our <b>minimum deposit amount is $5</b>.</p>
          <br>
          <br>
          <p>After that, you will be redirected to the page where you can complete your <strong>deposit</strong>:</p>
          <br>
          <img src="../img/topup2.png" alt="">
          <br>
          <br>
          <br>
          <p>Just choose the required cryptocurrency network and press <strong>"Continue"</strong>.</p><br>
          <p><i>Gently tip: <strong>TRC20</strong> has the lowest fees and the fastest transactions. As usual, TRC20 network fee on the Binance side is: <strong>$1.00</strong>. Bigger deposit = lower fee.</i></p>
          <br>
          <br>
          <p>On the next page, you are be able to locate the cryptoaddress where the money should be sent:</p>
          <br>
          <img src="../img/topup3.png" alt="">
          <br>
          <br>
          <br>
          <p>In our <strong>example</strong>, the cryptoaddress is: </p>
          <br>
          <div class="apiexample">
            <p><b>TNvqXPTg9Txa79uSJeFphT63kL1BAKESq8</b></p>
          </div>
          <br>
          <p><i><b>IMPORTANT: It is required to copy/paste the address correctly. If the money is sent to the wrong destination address, it will be lost forever!</b></i></p>
          <br>
          <br>
          <p><i><b>IMPORTANT: Also, please make sure to send all the amount with the fee included. In our example, the amount of 10.66 USDT should be sent:</b></i></p>
          <br>
          <img src="../img/topup4.png" alt="">
          <br>
          <br>
          <br>
          <p><i>Please contact us if you have sent the wrong amount. We will try resolving this situation for you.</i> </p>
          <br>
          <p>In order to send money on the Binance side, you need go to your Spot wallet and click on the <strong>Withdraw</strong> button.</p>
          <br>
          <br>
          <p>On the next step, you need to enter the correct <strong>cryptoaddress</strong>, currency network that was choosen before <i>(TRC20 in our case)</i> and the required amount with the <strong>network fee</strong> included:</p>
          <br>
          <img src="../img/topup5.png" alt="">
          <br>
          <br>
          <p>Usually, such deposits reach the destination address in <strong>10 minutes</strong>. Please do not close the pay page during this time.</p>
          <br>
          <br>
          <p>After all required confirmations you will be redirected to the following page:</p>
          <br>
          <img src="../img/topup6.png" alt="">
          <br>
          <br>
          <br>
          <p><b>That is all!</b> Money will appear in your <strong>Mr.PNL</strong> balance within 2 hours after successful transaction. You may contact us via <strong>email or Telegram</strong> if you would like to check the status of your transaction.</p>
          <br>
          <br>
          <p>Feel free to contact our support if you have any questions or require help.</p>
          <br>
          <br>
          <div class="mrpnlfooter">
            <p>MR.PNL</p>
          </div>
        </div>
      </div>
      </div>
      <?php include "../footer.php"; ?>
    </div>
  </body>
  <script type="text/javascript" src="js/phonenumber.js"></script>
</html>
