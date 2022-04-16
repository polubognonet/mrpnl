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
      <div class="wrappertopup">
        <?php include "currencyinfo1.php"; ?>
        <?php include "helloworld.php"; ?>
        <div class="hellomobile">
          <p>TOP UP</p>
        </div>
        <div class="phverify">
          <div class="phonenumberheader">
            <a href="https://mrpnl.com/myaccount/topup.php"><img src="img/back.png" alt=""></a>
            <div class="mainheader">
              <h3>Top Up</h3>
            </div>
          </div>
          <div class="enterphone">

            <div class="phonedisclaimer">
              <img src="img/ideallogo.png" alt="">
              <p>This is a top up page. Please note that minumum deposit is $5. You need to enter the required amount and pay it on another tab.</p>
              <p>Your deposit should appear in your account within 2 hours after the transaction. If you feel that it takes more time, please contact our Support via <strong><a href="https://t.me/mrpnl">Telegram</a></strong> or <strong>support@mrpnl.com</strong> email address.</p>
              <p>It is possible to pay with cryprocurrenies only for now. We are really sorry if this process could make any inconveniences for you. Your understanding is highly appreciated.</p>
              <p>We are not using your personal information. You can be sure that any data entered is absolutely safe. Click here to check our <strong><a href="https://mrpnl.com/en/privacypolicy/">Privacy Policy</a></strong>.</p>
            </div>

            <div class="container">
              <div class="containerheader">
                <p>CONFIRM DEPOSIT</p>
              </div>
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
              <form name="payment" method="post" action="https://sci.any.money/invoice" accept-charset="UTF-8">
                <?php include "includes/pay.inc.php"; ?>
                <?php foreach ($res as $k=> $v): ?>
                  <input type="hidden" name="<?= $k; ?>" value="<?= $v; ?>"/>
                <?php endforeach; ?>
                <?php

                if ($_POST['amount']<5) {
                  echo "<input class='paybutton' type='button' onclick='badinputTopUP()' value='CONFIRM'>";
                } else {
                  echo "<input class='paybutton' type='submit' value='CONFIRM'>";
                }
                 ?>
              </form>
              <img src="img/topup.png" alt="">
            </div>



            <div class="phonedisclaimerphone">
              <img src="img/ideallogo.png" alt="">
              <p>This is a top up page. Please note that minumum deposit is $5. You need to enter the required amount and pay it on another tab.</p>
              <p>Your deposit should appear in your account within 2 hours after the transaction. If you feel that it takes more time, please contact our Support via <strong><a href="https://t.me/mrpnl">Telegram</a></strong> or <strong>support@mrpnl.com</strong> email address.</p>
              <p>It is possible to pay with cryprocurrenies only for now. We are really sorry if this process could make any inconveniences for you. Your understanding is highly appreciated.</p>
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
