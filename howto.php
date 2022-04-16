<?php

session_start();
include 'includes/dbh.inc.php';
include 'includes/userparsing.inc.php';

if (!isset ($user['user_login'])) {
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/input.css">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/mobilestyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon16.png" sizes="16x16" />
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
      include "header.php";
       ?>
      <div class="wrapper" style="height: 1100px;">
        <?php include "currencyinfo1.php"; ?>
        <?php include "helloworld.php"; ?>
        <div class="hellomobile">
          <p>FAQ</p>
        </div>
        <?php include "accountinformation.php"; ?>
        <div class="phverify" style="height: 51%;">
          <div class="phonenumberheader">
            <a href="https://mrpnl.com/myaccount/"><img src="img/back.png" alt=""></a>
            <div class="mainheader">
              <h3>FAQ</h3>
            </div>
          </div>
          <div class="faqdiv">
            <ul>
              <li> <a href="https://mrpnl.com/myaccount/faq/whatisapi.php"> - What is API information? </a></li>
              <li> <a href="https://mrpnl.com/myaccount/faq/howtostart.php"> - How to start a bot? </a></li>
              <li> <a href="https://mrpnl.com/myaccount//faq/topup.php"> - How to top up balance? </a></li>
              <li> <a href="https://mrpnl.com/myaccount/faq/disablenotifications.php"> - How to disable notifications? </a></li>
              <li> <a href="https://mrpnl.com/myaccount/faq/referralprofit.php"> - How to withdraw referral profit? </a></li>
              <li style="border-bottom:none;"> <a href="https://mrpnl.com/myaccount/faq/verify.php"> - How to verify an account? </a></li>
            </ul>
          </div>
        </div>
      </div>
      <?php include "footer.php"; ?>
    </div>
  </body>
  <script type="text/javascript" src="js/phonenumber.js"></script>
</html>
