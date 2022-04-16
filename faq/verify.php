<?php

session_start();
include '../includes/dbh.inc.php';
include '../includes/userparsing.inc.php';

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
              <h3>How to verify an account?</h3>
            </div>
          </div>
          <div class="maintopic">
            <p>Account verification is required in order to start a bot. If your account is not verified, you are able to do it automatically here:<strong><a href="https://mrpnl.com/myaccount/pverify.php">https://mrpnl.com/myaccount/pverify.php</a></strong>.</p>
            <br>
            <br>
            <p>First of all, you need to choose the required country and enter your phone number:</p>
            <br>
            <img src="../img/verifyphone1.png" alt="">
            <br>
            <br>
            <br>
            <p>On the next page, you will need to enter the OTP code that is sent to your device:</p>
            <br>
            <img src="../img/verifyphone2.png" alt="">
            <br>
            <br>
            <br>
            <p><strong>That is all!</strong>, your account is verified and you are ready to start earning money.</p>
            <br>
            <br>
            <p>It is possible to verify your account manualy by using <strong>Telegram</strong> as well. Please contact us <strong><a href="https://t.me/mrpnl">(@mrpnl)</a></strong> in order to do so.</p>
            <br>
            <br>
            <p>Please contact us if you have any questions or require help. Thank you for using our service!</p>
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
