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
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  </head>

  <body>
    <div class="loader-wrapper">
      <div class="loader"></div>
    </div>
  <div class="wwrapper">
    <?php
    include "../header.php";
     ?>
    <div class="wrapper">
      <?php include "currencyinfo1.php"; ?>
      <?php include "../helloworld.php"; ?>
      <div class="banners">
        <img src="img/topupbanner.png" alt="">
      </div>
      <div class="hellomobile">
        <p>TOP UP</p>
      </div>
      <div class="topupwrap">
          <div class="phonedisclaimer">
            <div class="phonedisclaimerheader">
              <p>VERIFICATION</p>
            </div>
            <div class="phonedisclaimerbody">
              <div class="phonedisclaimerbodywrap">
            <p>This is a phone verification page. Please make sure to insert your real phone number. You will need to enter the OTP code that should be sent to your device within 2 minutes.</p>
            <p>It is possible to try verifying your phone number 5 times only. In case you were not able to verify it within these attempts, please contact our Support via <strong><a href="https://t.me/mrpnl">Telegram</a></strong>.</p>
            <p>Verification is created in order to avoid trial period abuse. We are really sorry if this process could make any inconveniences for you. Your understanding is highly appreciated.</p>
            <p>We are not using your personal information. You can be sure that any data entered is absolutely safe. Click here to check our <strong><a href="https://mrpnl.com/en/privacypolicy/">Privacy Policy</a></strong>.</p>
            <div class="mrpnldivp">
              <p>MR.PNL</p>
            </div>
              </div>
            </div>
          </div>
          <div class="phonecontainer">
            <div class="containerheader">
              <p>ENTER NUMBER</p>
            </div>
            <div class="pcontainerbody">
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
            <div class="orline">
              <div class="orline12">
                <div class="orline1">

                </div>
                <div class="orline2">

                </div>
              </div>
              <div class="orword">
                <p>OR</p>
              </div>
              <div class="orline12">
                <div class="orline1">

                </div>
                <div class="orline2">

                </div>
              </div>
            </div>
            <div class="telegrambutton">
              <button type="button" name="button" href="https://t.me/mrpnl_bot" target="_blank">Verify via Telegram</button>
            </div>
            </div>
          </div>
      </div>
    </div>
    <?php include "../footer.php"; ?>
  </div>
</body>
<script type="text/javascript" src="../js/phonenumber.js"></script>

<script>
function validate(evt) {
var theEvent = evt || window.event;

// Handle paste
if (theEvent.type === 'paste') {
    key = event.clipboardData.getData('text/plain');
} else {
// Handle key press
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
}
var regex = /[0-9]|\./;
if( !regex.test(key) ) {
  theEvent.returnValue = false;
  if(theEvent.preventDefault) theEvent.preventDefault();
}
}
</script>

<script type="text/javascript">

var rng = document.getElementById("depositInput");

function inputButton(){

  var button = document.getElementById("depositButton");
  var depositAmount = rng.value;
  var rng17 = parseInt(depositAmount);

  console.log(rng17);

  if (rng17 < 5) {
    button.disabled = true;
    document.querySelector("#depositButton").style.background = "#eabcbc";
    document.querySelector("#depositButton").style.border = "2px solid #eabcbc";
  } else if (rng17 > 5) {
    button.disabled = false;
    document.querySelector("#depositButton").style.background = "#dff2d9";
    document.querySelector("#depositButton").style.border = "2px solid #dff2d9";

  }

};

window.addEventListener("DOMContentLoaded", inputButton);
rng.addEventListener('input', inputButton);

</script>


<script>

$('#coin1').hover(
   function() {
      $('#coin1 p').addClass('pcoinhover')
      $('#coin1').addClass('coindivhover')
      $('#coin1 .coinimg img').addClass('changeimgcolor')
   },
   function() {
     $('#coin1 p').removeClass('pcoinhover')
     $('#coin1').removeClass('coindivhover')
     $('#coin1 .coinimg img').removeClass('changeimgcolor')
   }
)

$('#coin2').hover(
   function() {
      $('#coin2 p').addClass('pcoinhover')
      $('#coin2').addClass('coindivhover')
      $('#coin2 .coinimg img').addClass('changeimgcolor')
   },
   function() {
     $('#coin2 p').removeClass('pcoinhover')
     $('#coin2').removeClass('coindivhover')
     $('#coin2 .coinimg img').removeClass('changeimgcolor')
   }
)

$('#coin3').hover(
   function() {
      $('#coin3 p').addClass('pcoinhover')
      $('#coin3').addClass('coindivhover')
      $('#coin3 .coinimg img').addClass('changeimgcolor')
   },
   function() {
     $('#coin3 p').removeClass('pcoinhover')
     $('#coin3').removeClass('coindivhover')
     $('#coin3 .coinimg img').removeClass('changeimgcolor')
   }
)

$('#coin4').hover(
   function() {
      $('#coin4 p').addClass('pcoinhover')
      $('#coin4').addClass('coindivhover')
      $('#coin4 .coinimg img').addClass('changeimgcolor')
   },
   function() {
     $('#coin4 p').removeClass('pcoinhover')
     $('#coin4').removeClass('coindivhover')
     $('#coin4 .coinimg img').removeClass('changeimgcolor')
   }
)

</script>

</html>
