<?php

session_start();
include_once 'includes/dbh.inc.php';
include_once 'includes/userparsing.inc.php';

if (!isset($user['user_login'])) {
  header("Location: https://mrpnl.com/en/login-2/");
  exit();
} elseif ($user['phoneverified']=="1") {
  header("Location: https://mrpnl.com/myaccount/index.php?verified");
  exit();
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/input.css">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/mobilestyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <script type="text/javascript" src="js/functions.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script
 src="https://code.jquery.com/jquery-3.6.0.js"
 integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
 crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  </head>
    <body>
      <div class="loader-wrapper">
        <div class="loader"></div>
      </div>
    <div class="wwrapper">
      <?php
      include_once 'includes/pnverify.inc.php';
       ?>
      <?php
      include "header.php";
       ?>
      <div class="wrapperphone">
        <?php include "currencyinfo1.php"; ?>
        <?php include "helloworld.php"; ?>
        <div class="hellomobile">
          <p>VERIFICATION</p>
        </div>
        <?php include "accountinformation.php"; ?>
        <div class="phverify">
          <div class="phonenumberheader">
            <a href="https://mrpnl.com/myaccount/"><img src="img/back.png" alt=""></a>
            <div class="mainheader">
              <h3>Phone Verification</h3>
            </div>
          </div>
          <div class="enterphone">
            <div class="phonedisclaimer">
              <img src="img/ideallogo.png" alt="">
              <p>This is a phone verification page. Please make sure to insert your real phone number. You will need to enter the OTP code that should be sent to your device within 2 minutes.</p>
              <p>It is possible to try verifying your phone number 5 times only. In case you were not able to verify it within these attempts, please contact our Support via <strong><a href="https://t.me/mrpnl">Telegram</a></strong>.</p>
              <p>Verification is created in order to avoid trial period abuse. We are really sorry if this process could make any inconveniences for you. Your understanding is highly appreciated.</p>
              <p>We are not using your personal information. You can be sure that any data entered is absolutely safe. Click here to check our <strong><a href="https://mrpnl.com/en/privacypolicy/">Privacy Policy</a></strong>.</p>
            </div>
            <div class="container">
              <div class="containerheader">
                <p>ENTER NUMBER</p>
              </div>
              <form id="login" onsubmit="process(event)">
                <input id="phone" type="tel" name="phone" />
                <?php if ($user['phonevercount']>=5) {
                echo "<input type='button' class='btn' onclick='fiveTimesNumber()' value='Verify phone' style = 'margin-top: 5%;' />";
              } elseif ($user['otpvercount']>=10) {
                echo "<input type='button' class='btn' onclick='tenTimesOTP()' value='Verify phone' style = 'margin-top: 5%;' />";
              } else {
                echo "<input type='submit' class='btn' value='Verify phone' style = 'margin-top: 5%;' />";
                }?>
              </form>
              <?php if (isset($_GET['number'])) {
                echo "<p class = 'errormessage'>This phone number is already registered, unfortunately.</p>";
              } elseif (isset($_GET['otpcode'])) {
                $currentattempts = 5 - $user['phonevercount'];
                echo "<p class = 'errormessage'>The code entered is incorrect. Please try verifying your number once again. You have " . $currentattempts . " attempts left.</p>";
              }?>
              <p class="containerpdesc">If you do not want to enter your phone number, you can verify your account manualy via Telegram support. Please contact us <strong><a href="https://t.me/mrpnl">here</a></strong>. It could take up to 2 hours.</p>
            </div>
            <div class="phonedisclaimerphone">
              <img src="img/ideallogo.png" alt="">
              <p>This is a phone verification page. Please make sure to insert your real phone number. You will need to enter the OTP code that should be sent to your device within 2 minutes.</p>
              <p>It is possible to try verifying your phone number 5 times only. In case you were not able to verify it within these attempts, please contact our Support via <strong><a href="https://t.me/mrpnl">Telegram</a></strong>.</p>
              <p>Verification is created in order to avoid trial period abuse. We are really sorry if this process could make any inconveniences for you. Your understanding is highly appreciated.</p>
              <p>We are not using your personal information. You can be sure that any data entered is absolutely safe. Click here to check our <strong><a href="https://mrpnl.com/en/privacypolicy/">Privacy Policy</a></strong>.</p>
            </div>
          </div>
        </div>
      </div>
      <?php include "footer.php"; ?>
    </div>
  </body>
  <script type="text/javascript" src="js/phonenumber.js"></script>
</html>
