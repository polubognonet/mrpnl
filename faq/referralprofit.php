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
              <h3>How to withdraw referral profit?</h3>
            </div>
          </div>
          <div class="maintopic">
            <p>You are able to receive money for every person that registered with your referral code. More information is located in the <strong>Deposit and Referrals</strong> section on the <strong><a href="https://mrpnl.com/myaccount/">Home</a></strong> page. </p>
            <br>
            <img src="../img/referral1.png" alt="">
            <br>
            <br>
            <br>
            <p>With this referral program you are receiving <strong>5%</strong> of the invited people's profits.</p>
            <br>
            <br>
            <p>The minimum withdrawal amount is: <strong>20$</strong>.</p>
            <br>
            <br>
            <p>Please contact us via <strong>email or Telegram</strong> if you would like to receive your profits. Money will be sent on any preferable cryptoaddress via TRC20 network.</p>
            <br>
            <br>
            <p>Feel free to ask us a question if you have any. Thank you for using our service!</p>
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
