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
              <h3 style="font-size: 32px;">How to start a bot?</h3>
            </div>
          </div>
          <div class="maintopic">
            <p><b>Start in a few steps!</b> It is very easily to start earning money with our bot.</p>
            <br>
            <br>
            <p>First of all, you need to choose <strong>the required bot</strong> and enter <strong>API details</strong> on the <strong><a href="https://mrpnl.com/myaccount/">Home page</a></strong>:</p>
            <br>
            <img src="../img/howtostart1.png" alt="">
            <br>
            <br>
            <br>
            <p>Do not know where to locate API information? Here is a guide that could help you: <strong><a href="https://mrpnl.com/myaccount/faq/whatisapi.php">https://mrpnl.com/myaccount/faq/whatisapi.php</a></strong></p>
            <br>
            <br>
            <p>After that, please make sure that you have enough money on your <strong>Binance Spot wallet:</strong></p>
            <br>
            <img src="../img/howtostart.png" alt="">
            <br>
            <br>
            <br>
            <p>Finally, you need to <strong>choose the currency</strong> and <strong>enter the deposit</strong> that will be used for automated trading:</p>
            <br>
            <img src="../img/howtostart5.png" alt="">
            <br>
            <br>
            <br>
            <p>After these actions, you will be able to start a bot.</p>
            <br>
            <br>
            <p><strong>That's it!</strong> If you have any questions, please <strong>contact our support</strong> for further investigation. We will gladly assist you with your queries!</p>
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
