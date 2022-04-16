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

      <?php include "popup.php"; ?>

      <div class="loader-wrapper">
        <div class="loader"></div>
      </div>

      <?php if (isset($_GET['verify'])) {
            echo "<script type='text/javascript'>swal('Great!', 'Your account is verified now.', 'success');</script>";
          } elseif (isset($_GET['verified'])) {
                echo "<script type='text/javascript'>swal('Great!', 'Your account is already verified. Feel free to start using our services.', 'success');</script>";
          } elseif ($_GET['api']=="success") {
            echo "<script type='text/javascript'>swal('Great!', 'API seetings has been changed.', 'success');</script>";
          } elseif ($_GET['api']=="bad") {
            echo "<script type='text/javascript'>swal('Error!', 'It appears that your API details are not correct. Feel free to check our guide on the How to page if you have any questions.', 'error');</script>";
          } elseif ($_GET['deposit']=="success") {
            echo "<script type='text/javascript'>swal('Done!', 'Your deposit has been changed!', 'success');</script>";
          } elseif (isset($_GET['udeposit'])) {
            echo "<script type='text/javascript'>swal('Error!', 'It appears that you do not have enough USDT available on your Binance balance. You may check it in the Binance Information section above.', 'error');</script>";
          } elseif (isset($_GET['bdeposit'])) {
            echo "<script type='text/javascript'>swal('Error!', 'It appears that you do not have enough BUSD available on your Binance balance. You may check it in the Binance Information section above.', 'error');</script>";
          } elseif (isset($_GET['disable'])) {
            echo "<script type='text/javascript'>swal('Done!', 'Your bot is disabled now.', 'success');</script>";
          } elseif (isset($_GET['start'])) {
            echo "<script type='text/javascript'>swal('Done!', 'Your bot is in progress status. It will become enabled in 2 hours. Thank you for your patience.', 'success');</script>";
          } elseif (isset($_GET['pmonths'])) {
            echo "<script type='text/javascript'>swal('Error!', 'Please note that the Months field must consist of numbers only and cannot be empty!', 'error');</script>";
          } elseif (isset($_GET['pdeposit'])) {
            echo "<script type='text/javascript'>swal('Error!', 'Please note that the Deposit field must consist of numbers only and cannot be empty!', 'error');</script>";
          }
      ?>

      <div class="wwrapper">
        <?php include "needhelp.php"; ?>
      <?php
      include "../header.php";
       ?>
      <div class="wrapper">

      <?php include "currencyinfo1.php"; ?>

        <?php include "../helloworld.php"; ?>
        <div class="hellomobile">
          <p>HOME</p>
        </div>
          <div class="banners">
            <img src="../img/banner11.png" alt="">
          </div>
          <div class="accountpanel">

          <div class="botconfigurationpan">
            <div class="bot-row-1">
              <?php include "depositinformation.php"; ?>
              <?php include "availablebots.php"; ?>
            </div>
            <div class="bot-row-2">
              <?php include "setdeposit.php"; ?>
              <?php include "additionalsettings.php"; ?>
            </div>


          <?php include "balancereferals.php"; ?>

          </div>

          <div class="botconfigurationpanchoose">
            <div class="choosediv" href="#depositid">
              <div class="choosespacer">
              </div>
              <div class="chooseimg">
                <a href="#depositid">
                  <img src="../img/depositid.png" alt="" href="#depositid">
                  <p>STATUS</p>
                </a>
              </div>
            </div>
            <div class="choosediv" href="#balanceid">
              <div class="choosespacer">
              </div>
              <div class="chooseimg">
                <a href="#balanceid">
                  <img src="../img/balanceid.png" alt="" href="#balanceid">
                  <p>DEPOSIT</p>
                </a>
              </div>
            </div>
            <div class="choosediv" href="#botsid">
              <div class="choosespacer">
              </div>
              <div class="chooseimg">
                <a href="#botsid">
                  <img src="../img/botid.png" alt="" href="#botsid">
                  <p>BOTS</p>
                </a>
              </div>
            </div>
            <div class="choosediv" style="border-right: none;" href="#apiid">
              <div class="choosespacer">
              </div>
              <div class="chooseimg">
                <a href="#apiid">
                  <img src="../img/apiid.png" alt="" href="#apiid">
                  <p>API</p>
                </a>
              </div>
            </div>
          </div>

          <?php include "createstrategy.php"; ?>

          <?php include "profitcalculator.php"; ?>

          </div>
      </div>
      </div>
      <?php include "../footer.php"; ?>

      <script>
      $('.choosediv').on('click', function(e) {
var el = $( e.target.getAttribute('href') );
var elOffset = el.offset().top;
var elHeight = el.height();
var windowHeight = $(window).height();
var offset;

if (elHeight < windowHeight) {
offset = elOffset - ((windowHeight / 2) - (elHeight / 2));
}
else {
offset = elOffset;
}
var speed = 400;
$('html, body').animate({scrollTop:offset}, speed);
});

$('#strategyButtonId, #startBotButton').click(
  function() {
  preloaderFadeInTime = 1000;
  var preloader = $('.loader-wrapper');
  preloader.fadeIn(preloaderFadeInTime);
  });

    </script>
<script type="text/javascript">
    const list = document.querySelectorAll('.choosediv');
    function activeLink() {
      list.forEach((item) =>
      item.classList.remove('active'));
      this.classList.add('active');
    }
    list.forEach((item) =>
    item.addEventListener('click',activeLink));

    const list = document.querySelectorAll('.needhelp');
    function activeLink() {
      list.forEach((item) =>
      item.classList.remove('mystyleneedhelp'));
      this.classList.add('mystyleneedhelp');
    }
    list.forEach((item) =>
    item.addEventListener('click',activeLink));

</script>

    </body>
</html>
