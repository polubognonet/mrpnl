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
              <h3>What is API information?</h3>
            </div>
          </div>
          <div class="maintopic">
            <p><strong>An application programming interface (API)</strong> is a connection between computers or between computer programs.</p><br>
            <p>API access allows you to use any third-party services safely. It means that money always located on your wallets, we do not have any options to withdraw them.</p><br>
            <br>
            <p>Here is an example on how <strong>API Key</strong> and <strong>Secret Key</strong> should look like:</p><br>
            <div class="apiexample">
              <p><b>API Key:</b></p>
              <p class="apiexmple"><i>pfQCgfLohPT3vLbsflasjdhf23784kQuboNAL54Bo</i></p>
              <p><b>Secret Key:</b></p>
              <p class="apiexmple"><i>soidgfuoisAaeswfuoehueswhfaoe32uhr8923hAs</i></p>
            </div> <br>
            <br>
            <p>Also, here is an official Binance guide about the API creating: <strong><a href="https://www.binance.com/en/support/faq/360002502072">https://www.binance.com/en/support/faq/360002502072</a></strong> </p> <br>
            <br>
            <p>Make sure to create API with <strong>"Enable Reading"</strong> and <strong>"Enable Spot & Margin Trading"</strong>:</p> <br>
            <img src="../img/apiaccess2.png" alt="">
            <br>
            <br>
            <br>
            <p>After that, you will need to enter the required information into the <strong>API section</strong> on the Home page:</p> <br>
            <img style="border:none;" src="../img/apiaccess3.png" alt="">
            <br>
            <br>
            <br>
            <p><b>That's all! </b>Feel free to contact us if you have any issues with the <strong>API information</strong>. We will gladly assist you with your questions.</p>
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
